//Variable con valores por cada municipio
//var anaco = "<h2>Municipio Anaco</h2><p>Cantidad de Solicitudes: 700.343, Representa: 56,34%</p>";
var anaco = document.getElementById("municipio_Anaco").value;
var aragua = document.getElementById("municipio_Aragua").value;
var bolivar = document.getElementById("municipio_Bolivar").value;
var bruzual = document.getElementById("municipio_Bruzual").value;
var cajigal = document.getElementById("municipio_Cajigal").value;
var carvajal = document.getElementById("municipio_Carvajal").value;
var urbaneja = document.getElementById("municipio_Urbaneja").value;
var freite = document.getElementById("municipio_Freites").value;
var guanipa = document.getElementById("municipio_Guanipa").value;
var guanta = document.getElementById("municipio_Guanta").value;
var independencia = document.getElementById("municipio_Independencia").value;
var libertad = document.getElementById("municipio_Libertad").value;
var mcgregor = document.getElementById("municipio_Mcgregor").value;
var miranda = document.getElementById("municipio_Miranda").value;
var monagas = document.getElementById("municipio_Monagas").value;
var penalver = document.getElementById("municipio_Penalver").value;
var piritu = document.getElementById("municipio_Piritu").value;
var capistrano = document.getElementById("municipio_Capistrano").value;

var santaana = document.getElementById("municipio_Santa_Ana").value;
var simonrodriguez = document.getElementById("municipio_Simon_Rodriguez").value;
var sotillo = document.getElementById("municipio_Sotillo").value;
//mapa
var mapa = new L.map('mi-mapa', {
    // center: [10.13625, -64.68618], //Cordenadas de barcelona, sistema decimal simple
    center: [9.3057100, -64.3584100], //Cordenadas de cantaura, sistema decimal simple
    zoom: 8
});
var capaOSM = new L.tileLayer('http://tile.openstreetmap.org/{z}/{x}/{y}.png');
var capaRelieve = new L.tileLayer('http://tile.stamen.com/terrain/{z}/{x}/{y}.jpg');

//capaRelieve.addTo(mapa);
capaOSM.addTo(mapa);

var capasBase = {
    "Relieve": capaRelieve,
    "OpenStreetMap": capaOSM
};

var selectorCapas = new L.control.layers(capasBase);
selectorCapas.addTo(mapa);

//Agregar marcadores e iconos
var estiloPopup = {'maxWidth': '300'}

var iconoBase = L.Icon.extend({
    options: {
        iconoSize: [24, 39],
        iconoAnchor: [16, 15],
        popupAnchor: [1, -15]

    }
});

var iconoVerde = new iconoBase({iconUrl: '../leaflet/images/verde.png'}),
        iconoRojo = new iconoBase({iconUrl: 'rojo.png'}),
        iconoAzul = new iconoBase({iconUrl: 'azul.png'});



//Agregar los marcadores
L.marker([9.43417, -64.4594], {icon: iconoVerde}).bindPopup(anaco, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([9.4575, -64.8261], {icon: iconoVerde}).bindPopup(aragua, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([10.1392, -64.6814], {icon: iconoVerde}).bindPopup(bolivar, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([9.4239, -65.1657], {icon: iconoVerde}).bindPopup(bruzual, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([9.59794, -65.1943], {icon: iconoVerde}).bindPopup(cajigal, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([9.91068, -65.6753], {icon: iconoVerde}).bindPopup(carvajal, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([10.2011, -64.6951], {icon: iconoVerde}).bindPopup(urbaneja, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([9.3, -64.35], {icon: iconoVerde}).bindPopup(freite, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([8.87998, -64.161], {icon: iconoVerde}).bindPopup(guanipa, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([10.2333, -64.6], {icon: iconoVerde}).bindPopup(guanta, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([8.218642, -63.570964], {icon: iconoVerde}).bindPopup(independencia, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([9.73953, -64.5494], {icon: iconoVerde}).bindPopup(libertad, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([9.15222, -65.0117], {icon: iconoVerde}).bindPopup(mcgregor, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([8.83333, -64.7], {icon: iconoVerde}).bindPopup(miranda, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([7.804687, -64.721141], {icon: iconoVerde}).bindPopup(monagas, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([10.065, -65.0446], {icon: iconoVerde}).bindPopup(penalver, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([10.0459, -65.0335], {icon: iconoVerde}).bindPopup(piritu, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([10.1318, -65.4219], {icon: iconoVerde}).bindPopup(capistrano, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([9.30878, -64.6599], {icon: iconoVerde}).bindPopup(santaana, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([8.89796, -64.2477], {icon: iconoVerde}).bindPopup(simonrodriguez, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });
L.marker([10.1984, -64.6365], {icon: iconoVerde}).bindPopup(sotillo, estiloPopup).addTo(mapa).on('mouseover', function (e) {
     this.openPopup();
  });



