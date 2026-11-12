/* =========================================================
   PROFESIONALES — editá esta lista para agregar, quitar o
   modificar médicos. El orden de la lista es el orden en la web.

   grupo: "cardio" | "arritmias" | "intervencion" | "otras"
   cobertura: líneas de texto sobre obras sociales (puede ir vacía)
   turno: link de Medexis para pedir turno online
   ========================================================= */
var MEDEXIS = "http://181.14.240.149/medexisportal/?to=9&cp=";

var MEDICOS = [
  { nombre: "Alvaro Martín Soriano", especialidad: "Cardiología, EcoDoppler y ECG", grupo: "cardio", foto: "AlvaroSoriano.jpg",
    cobertura: ["Recibe todas por Colegio Médico", "Descuento a pacientes de PAMI"], turno: MEDEXIS + "7YVNEXZ27PFHORPH" },
  { nombre: "Daniel Agustin Perillo", especialidad: "Cardiología, Mapa y Holter", grupo: "cardio", foto: "AgustinPerillo.jpeg",
    cobertura: ["Recibe todas por Colegio Médico", "No recibe: OSDE, OSPIA"], turno: MEDEXIS + "HB2PB12CGGJXUQGY" },
  { nombre: "Carlos Soriano", especialidad: "Cardiología y EcoDoppler", grupo: "cardio", foto: "CarlosSoriano.jpg",
    cobertura: ["Recibe todas por Colegio Médico", "Además: OSDE", "No recibe: Prensa, Boreal"], turno: MEDEXIS + "QENHT2G0UHRQLUID" },
  { nombre: "Lucía Córdoba", especialidad: "Cirugía general, especialista en Flebología", grupo: "otras", foto: "luciacordoba.jpg",
    cobertura: [], turno: MEDEXIS + "D0FFE7FD521B3691" },
  { nombre: "Andrea Pallares", especialidad: "Cardiología, Mapa y Holter", grupo: "cardio", foto: "pallares.jpg",
    cobertura: ["Recibe todas por Colegio Médico"], turno: MEDEXIS + "SRHSWPQYWZQCARHE" },
  { nombre: "Gabriel Edgardo Salica", especialidad: "Cardiología y Electrofisiología", grupo: "arritmias", foto: "edgardosalica.jpg",
    cobertura: ["Recibe todas por Colegio Médico"], turno: MEDEXIS + "0MVGM64AKOKKW1BJ" },
  { nombre: "Alejandro Mario Martínez", especialidad: "Cardiología intervencionista", grupo: "intervencion", foto: "AlejandroMartinez.png",
    cobertura: ["Recibe todas por Colegio Médico", "Además: Red de Seguros Médicos"], turno: MEDEXIS + "GTKKSRUHOC1JVJNZ" },
  { nombre: "Esteban Mario Ávila", especialidad: "Arritmias y Marcapasos", grupo: "arritmias", foto: "EstebanAvila.jpg",
    cobertura: ["Recibe todas por Colegio Médico", "Además: OSDE, Swiss Medical, Galeno y otras", "No recibe: OSPE, Boreal"], turno: MEDEXIS + "NKXHQCJDMEDLAGGS" },
  { nombre: "Valentina Deheza", especialidad: "Medicina familiar", grupo: "otras", foto: "deheza.jpeg",
    cobertura: [], turno: MEDEXIS + "DB57EA85E6FCEB58" },
  { nombre: "Santiago Javier Alonso", especialidad: "Nefrología", grupo: "otras", foto: "SantiagoAlonso.jpg",
    cobertura: ["Recibe todas las obras sociales", "Excepto: Swiss Medical"], turno: MEDEXIS + "3XNP3JBRPN8VDM" },
  { nombre: "Enrique Luis F. Alonso", especialidad: "Cardiología y EcoDoppler", grupo: "cardio", foto: "AlonsoEnrique2.jpeg",
    cobertura: ["Recibe todas por Colegio Médico"], turno: MEDEXIS + "ILGP6CUXUBZLLWJZ" },
  { nombre: "Bruno Nicolás Allori", especialidad: "Cirugía cardiovascular", grupo: "intervencion", foto: "BrunoAllori.jpeg",
    cobertura: ["Recibe todas por Colegio Médico"], turno: MEDEXIS + "TEI5JWQAZQZHOPHQ" },
  { nombre: "Luis Ernesto Pellegrini", especialidad: "Cardiología, Mapa y Holter", grupo: "cardio", foto: "LuisPellegrini.jpeg",
    cobertura: ["Recibe todas por Colegio Médico", "No recibe: Swiss Medical, OSDE, Boreal"], turno: MEDEXIS + "CQNFMFD0FRDSGDYI" },
  { nombre: "Alejandra Ciliberti", especialidad: "Neumonología", grupo: "otras", foto: "ciliberti.png",
    cobertura: ["Recibe todas por Colegio Médico", "Además: Prensa, OSDE"], turno: MEDEXIS + "ZFA6W6EDEGTCLQPA" },
  { nombre: "Verónica María Roldán", especialidad: "Cardiología, Mapa y Holter", grupo: "cardio", foto: "VeronicaRoldan.jpeg",
    cobertura: ["Recibe todas por Colegio Médico"], turno: MEDEXIS + "LQYVQLRUTBZIIZCG" },
  { nombre: "Felix Albano", especialidad: "Cardiología y Electrofisiología", grupo: "arritmias", foto: "FelixAlbano.png",
    cobertura: ["Recibe todas por Colegio Médico", "Además: OSDE, Prensa, Swiss Medical, ATSA, Asispre"], turno: MEDEXIS + "S/EG4/XXAJFIRTWR" },
  { nombre: "Paola María Merino", especialidad: "Cardiología, Mapa y Holter", grupo: "cardio", foto: "PaolaMerino.jpg",
    cobertura: ["Recibe todas por Colegio Médico", "Además: OSPIA", "No recibe: OSDE"], turno: MEDEXIS + "8YGABO5QFUHS7YPV" },
  { nombre: "María Celia Perez", especialidad: "Cardiología y Ergometría", grupo: "cardio", foto: "CeciliaPerez.jpeg",
    cobertura: ["No recibe múltiples obras sociales"], turno: MEDEXIS + "Q1FLN1ASB7HRCVFU" },
  { nombre: "Geronimo Alonso", especialidad: "Cardiología y Hemodinamia", grupo: "intervencion", foto: "geroalonso.jpeg",
    cobertura: ["Recibe todas por Colegio Médico"], turno: MEDEXIS + "4E8EDEB0A3B82A70" },
  { nombre: "Clarisa Aguirre", especialidad: "Lic. en Nutrición. Enfermedades cardiovasculares, obesidad y diabetes", grupo: "otras", foto: "clarisaaguirre.jpeg",
    cobertura: ["Solo particular"], turno: MEDEXIS + "60A9E0A4FCBE12E7" }
];
