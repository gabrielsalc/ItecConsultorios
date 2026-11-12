(function () {
  "use strict";

  /* ---------- Menú mobile ---------- */
  var nav = document.querySelector(".site-nav");
  var toggle = document.querySelector(".nav-toggle");
  if (toggle && nav) {
    toggle.addEventListener("click", function () {
      var open = nav.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
    nav.querySelectorAll(".nav-links a").forEach(function (a) {
      a.addEventListener("click", function () {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
      });
    });
  }

  /* ---------- Sombra del navbar al scrollear ---------- */
  var onScroll = function () {
    if (nav) nav.classList.toggle("is-scrolled", window.scrollY > 8);
  };
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  /* ---------- Profesionales ---------- */
  var grid = document.getElementById("medicos");
  var search = document.getElementById("buscar-medico");
  var chips = document.querySelectorAll(".chip[data-grupo]");
  var empty = document.getElementById("medicos-vacio");
  var count = document.getElementById("medicos-count");
  var grupoActual = "todos";

  function norm(s) {
    return String(s).toLowerCase().normalize("NFD").replace(/[̀-ͯ]/g, "");
  }

  // Las fichas vienen en el HTML (generadas en PHP, así Google las lee);
  // acá solo se muestran u ocultan según el filtro.
  var cards = grid ? Array.prototype.slice.call(grid.querySelectorAll(".doc")) : [];
  cards.forEach(function (card) {
    var n = card.querySelector(".doc-name"), s = card.querySelector(".doc-spec");
    card._texto = norm((n ? n.textContent : "") + " " + (s ? s.textContent : ""));
  });

  function render() {
    if (!grid) return;
    var q = norm(search ? search.value.trim() : "");
    var visibles = 0;
    cards.forEach(function (card) {
      var okGrupo = grupoActual === "todos" || card.getAttribute("data-grupo") === grupoActual;
      var okTexto = !q || card._texto.indexOf(q) !== -1;
      var ver = okGrupo && okTexto;
      card.hidden = !ver;
      if (ver) visibles++;
    });
    var lista = { length: visibles };

    if (empty) {
      empty.hidden = lista.length !== 0;
      var qEl = empty.querySelector("[data-q]");
      if (qEl) qEl.textContent = search ? search.value.trim() : "";
    }
    if (count) {
      count.textContent = lista.length === 1 ? "1 profesional" : lista.length + " profesionales";
    }
  }

  chips.forEach(function (chip) {
    chip.addEventListener("click", function () {
      grupoActual = chip.getAttribute("data-grupo");
      chips.forEach(function (c) { c.setAttribute("aria-pressed", c === chip ? "true" : "false"); });
      render();
    });
  });
  if (search) search.addEventListener("input", render);
  render();

  /* ---------- Servicios (tabs) ---------- */
  var tabs = Array.prototype.slice.call(document.querySelectorAll(".svc-tab"));
  function selectTab(tab, focus) {
    tabs.forEach(function (t) {
      var on = t === tab;
      t.setAttribute("aria-selected", on ? "true" : "false");
      t.tabIndex = on ? 0 : -1;
      var panel = document.getElementById(t.getAttribute("aria-controls"));
      if (panel) panel.hidden = !on;
    });
    if (focus) tab.focus();
  }
  tabs.forEach(function (tab, i) {
    tab.addEventListener("click", function () { selectTab(tab, false); });
    tab.addEventListener("keydown", function (e) {
      var k = e.key, n = null;
      if (k === "ArrowDown" || k === "ArrowRight") n = tabs[(i + 1) % tabs.length];
      if (k === "ArrowUp" || k === "ArrowLeft") n = tabs[(i - 1 + tabs.length) % tabs.length];
      if (k === "Home") n = tabs[0];
      if (k === "End") n = tabs[tabs.length - 1];
      if (n) { e.preventDefault(); selectTab(n, true); }
    });
  });

  /* ---------- Año del footer ---------- */
  var y = document.getElementById("anio");
  if (y) y.textContent = new Date().getFullYear();
})();
