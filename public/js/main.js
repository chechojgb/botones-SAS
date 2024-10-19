import * as THREE from 'three';
import { GLTFLoader } from 'three/addons/loaders/GLTFLoader.js';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

// Crear escena, cámara y renderizador
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer({ canvas: document.getElementById('canvas3d') });
renderer.setSize(window.innerWidth, window.innerHeight);

renderer.setClearColor(0x000000, 0);

// Variable para almacenar el modelo
let model = null;
let distanceFromModel = 1;
let angle = 0;
let autoRotate = true; // Variable para habilitar/deshabilitar la rotación automática


const mediaQuery = window.matchMedia('(max-width: 768px)');

// Función para ajustar la distancia según el dispositivo
function updateDistance() {
    if (mediaQuery.matches) {
        // Si es móvil, ajusta la distancia a 3
        distanceFromModel = 3;
    } else {
        // Si no es móvil, la distancia es 1
        distanceFromModel = 1;
    }
}

updateDistance();

// Escucha cambios en la pantalla (en caso de cambiar el tamaño de la ventana)
mediaQuery.addEventListener('change', updateDistance);

// Aquí puedes seguir usando `distanceFromModel` en tu código
console.log(`La distancia es: ${distanceFromModel}`);


// Cargar el modelo glTF usando GLTFLoader
const loader = new GLTFLoader();
loader.load(modelUrl, function (gltf) {
  model = gltf.scene; // Almacenar el modelo cargado
  scene.add(model);
  
  // Centrar la cámara en el modelo
  const box = new THREE.Box3().setFromObject(model); // Calcular la caja delimitadora del modelo
  const center = box.getCenter(new THREE.Vector3()); // Obtener el centro del modelo
  
  // Posicionar la cámara inicialmente a una distancia fija del modelo
  camera.position.set(center.x + distanceFromModel, center.y, center.z); // Colocar la cámara a una distancia fija del modelo
  controls.target.copy(center); // Hacer que los controles de órbita apunten al centro del modelo
}, undefined, function (error) {
  console.error('Error al cargar el modelo:', error);
});

// Añadir luz a la escena
const light = new THREE.DirectionalLight(0xffffff, 1);
light.position.set(5, 5, 5).normalize();
scene.add(light);

// Añadir controles de órbita
const controls = new OrbitControls(camera, renderer.domElement);
controls.enableDamping = true; // Habilitar suavizado
controls.dampingFactor = 0.25; // Factor de suavizado
controls.screenSpacePanning = false; // Evitar el desplazamiento en el espacio de pantalla
controls.minDistance = 1; // Distancia mínima
controls.maxDistance = 100; // Distancia máxima, mayor para permitir más zoom
controls.target.set(0, 0, 0); // Mantener el modelo en el centro

// Evento para pausar permanentemente la rotación automática cuando el usuario interactúe
controls.addEventListener('start', () => {
  autoRotate = false; // Pausar la rotación automática indefinidamente
});

// Función para animar la escena
function animate() {
  requestAnimationFrame(animate);
  if (model && autoRotate) {
    // Actualizar la posición de la cámara en función del ángulo
    angle += 0.01; // Incrementar el ángulo para girar
    const box = new THREE.Box3().setFromObject(model); // Calcular la caja delimitadora del modelo
    const center = box.getCenter(new THREE.Vector3()); // Obtener el centro del modelo

    // Calcular la nueva posición de la cámara sin cambiar la distancia
    camera.position.x = center.x + Math.sin(angle) * distanceFromModel; // Calcular la posición X de la cámara
    camera.position.z = center.z + Math.cos(angle) * distanceFromModel; // Calcular la posición Z de la cámara
    camera.lookAt(center); // Hacer que la cámara mire al centro del modelo
  }

  // Actualizar controles
  controls.update();
  
  renderer.render(scene, camera);
}

animate();


