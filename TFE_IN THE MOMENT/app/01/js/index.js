
(function() {
  var animate, camera, clock, container, controls, cube, effect, element, fullscreen, init, render, renderer, resize, scene, update;

  clock = new THREE.Clock();

  init = function() {
    var face, geometry, i, light, material, mesh, ray, setOrientationControls, vertex, _i, _j, _k, _l, _len, _len1, _len2, _ref, _ref1, _ref2;
    renderer = new THREE.WebGLRenderer();
    element = renderer.domElement;
    container = document.getElementById('target');
    container.appendChild(element);
    effect = new THREE.StereoEffect(renderer);
    scene = new THREE.Scene();
    light = new THREE.DirectionalLight(0xffffff, 1);
    light.position.set(1, 1, 1);
    scene.add(light);
    light = new THREE.DirectionalLight(0xffffff, 0.75);
    light.position.set(-1, -0.5, -1);
    scene.add(light);
    ray = new THREE.Raycaster();
    ray.ray.direction.set(0, -1, 0);
    
    mesh = new THREE.Mesh(geometry, material);
    scene.add(mesh);
    geometry = new THREE.BoxGeometry(150, 150, 35);
    _ref2 = geometry.faces;
    for (_k = 0, _len2 = _ref2.length; _k < _len2; _k++) {
      face = _ref2[_k];
      face.vertexColors[0] = new THREE.Color().setHSL(Math.random() * 0 + 0 , 0, Math.random() * 1 + 0);
      face.vertexColors[1] = new THREE.Color().setHSL(Math.random() * 0 + 0 , 0, Math.random() * 1 + 0);
      face.vertexColors[2] = new THREE.Color().setHSL(Math.random() * 0 + 0 , 0, Math.random() * 1 + 0);
    }
    for (i = _l = 0; _l < 200; i = ++_l) {
      material = new THREE.MeshPhongMaterial({
        specular: 0xffffff,
        shading: THREE.FlatShading,
        vertexColors: THREE.VertexColors
      });
      mesh = new THREE.Mesh(geometry, material);
      mesh.position.x = Math.floor(Math.random() * 20 - 10) * 80;
      mesh.position.y = Math.floor(Math.random() * 20) * 20 + 120;
      mesh.position.z = Math.floor(Math.random() * 20 - 10) * 80;
      scene.add(mesh);
      material.color.setHSL(Math.random() * 0 + 0, 0, Math.random() * 1 + 0.);
    }
    camera = new THREE.PerspectiveCamera(90, 1, 0.001, 700);
    camera.position.set(0, 250, 0);
    scene.add(camera);
    controls = new THREE.OrbitControls(camera, element);
    controls.rotateUp(Math.PI / 4);
    controls.target.set(camera.position.x + 0.1, camera.position.y + 0, camera.position.z);
    controls.noZoom = true;
    controls.noPan = true;

    setOrientationControls = function(e) {
      if (!e.alpha) {
        return;
      }
      controls = new THREE.DeviceOrientationControls(camera, true);
      controls.connect();
      controls.update();
      element.addEventListener('click', fullscreen, false);
      window.removeEventListener('deviceorientation', setOrientationControls, true);
    };
    window.addEventListener('deviceorientation', setOrientationControls, true);
    
  
  };

  function resize() {
      var width = container.offsetWidth;
      var height = container.offsetHeight;

      camera.aspect = width / height;
      camera.updateProjectionMatrix();

      renderer.setSize(width, height);
      effect.setSize(width, height);
    }

    function update(dt) {
      resize();

      camera.updateProjectionMatrix();

      controls.update(dt);
    }

    function render(dt) {
      effect.render(scene, camera);
    }

    function animate(t) {
      requestAnimationFrame(animate);

      update(clock.getDelta());
      render(clock.getDelta());
    }

    function fullscreen() {
      if (container.requestFullscreen) {
        container.requestFullscreen();
      } else if (container.msRequestFullscreen) {
        container.msRequestFullscreen();
      } else if (container.mozRequestFullScreen) {
        container.mozRequestFullScreen();
      } else if (container.webkitRequestFullscreen) {
        container.webkitRequestFullscreen();
      }
  };

  init();

  animate();

}).call(this);
