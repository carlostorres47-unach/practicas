<!DOCTYPE html>
<html class="h-100" lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stratos Procurement — Solicitudes de compra</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <style>
    :root {
      --stratos-sidebar: #1a2b56;
      --stratos-page-bg: #eef1f5;
    }
    body { font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", sans-serif; }
    .app-sidebar {
      background: var(--stratos-sidebar);
      color: #fff;
      min-height: 100vh;
    }
    @media (min-width: 768px) {
      .app-sidebar { width: 260px; flex: 0 0 260px; }
    }
    .brand-title { font-weight: 800; letter-spacing: -0.02em; }
    .brand-sub {
      font-size: 0.65rem;
      letter-spacing: 0.12em;
      opacity: 0.65;
      text-transform: uppercase;
    }
    .nav-stratos .nav-link {
      color: rgba(255, 255, 255, 0.78);
      border-radius: 0.5rem;
      padding: 0.65rem 1rem;
      display: flex;
      align-items: center;
      gap: 0.65rem;
      font-weight: 500;
    }
    .nav-stratos .nav-link:hover { color: #fff; background: rgba(255, 255, 255, 0.08); }
    .nav-stratos .nav-link.active {
      background: #fff;
      color: var(--stratos-sidebar);
      font-weight: 600;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    .nav-stratos .nav-link.text-white-50:hover { color: #fff !important; }
    .app-main { background: var(--stratos-page-bg); min-height: 100vh; }
    .app-topbar {
      background: #f8f9fa;
      border-bottom: 1px solid #e9ecef;
      min-height: 64px;
    }
    .section-card {
      background: #fff;
      border-radius: 0.75rem;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
      border: 1px solid rgba(0, 0, 0, 0.04);
    }
    .label-caps {
      font-size: 0.68rem;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: #6c757d;
      margin-bottom: 0.35rem;
    }
    .section-card h3 { color: var(--stratos-sidebar); }
    .subtotal-box {
      background: rgba(26, 43, 86, 0.06);
      border-left: 4px solid var(--stratos-sidebar);
      border-radius: 0.5rem;
    }
    .table-actions { white-space: nowrap; width: 1%; }
    .search-input-wrap {
      max-width: 320px;
    }
    .avatar-placeholder {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: linear-gradient(135deg, #3d5a9e, #1a2b56);
    }
    .bento-cell {
      background: #fff;
      border-radius: 0.5rem;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }
    .bento-cell-inner {
      background: #f2f4f6;
      border: none;
      border-radius: 0.375rem;
    }
    .exec-muted { color: #6c757d; }
    .exec-primary { color: #1a365d; }
  </style>
</head>
<body class="bg-light">
  <div class="d-flex flex-column flex-md-row min-vh-100">
    <!-- Sidebar -->
    <aside class="app-sidebar p-3 p-md-4 d-flex flex-column">
      <div class="px-2 mb-4">
        <div class="brand-title fs-5">Stratos Procurement</div>
        <div class="brand-sub mt-1">Procurement ledger</div>
      </div>
      <nav class="nav flex-column nav-stratos flex-grow-1 px-1 gap-1">
        <a class="nav-link active" href="#" data-view="nueva" id="nav-nueva">
          <i class="bi bi-cart-plus fs-5"></i>
          <span>Nueva solicitud</span>
        </a>
        <a class="nav-link" href="#" data-view="historial" id="nav-historial">
          <i class="bi bi-clock-history fs-5"></i>
          <span>Historial</span>
        </a>
        <a class="nav-link" href="#" data-view="proveedores" id="nav-proveedores">
          <i class="bi bi-box-seam fs-5"></i>
          <span>Proveedores</span>
        </a>
      </nav>
      <div class="nav flex-column nav-stratos px-1 gap-1 border-top border-light border-opacity-25 pt-3 mt-2">
        <a class="nav-link text-white-50" href="#"><i class="bi bi-question-circle fs-5"></i><span>Ayuda</span></a>
        <a class="nav-link text-white-50" href="#"><i class="bi bi-box-arrow-right fs-5"></i><span>Cerrar sesión</span></a>
      </div>
    </aside>

    <!-- Main -->
    <div class="app-main flex-grow-1 d-flex flex-column min-w-0">
      <header class="app-topbar px-3 px-md-4 py-2 d-flex flex-wrap align-items-center gap-3 justify-content-between sticky-top">
        <h1 class="h5 mb-0 text-stratos fw-bold" id="page-title" style="color: #1a2b56;">Nueva solicitud de compra</h1>
        <div class="d-flex align-items-center gap-2 gap-md-3 flex-grow-1 flex-md-grow-0 justify-content-md-end">
          <div class="search-input-wrap flex-grow-1 flex-md-grow-0">
            <div class="input-group input-group-sm bg-white rounded border">
              <span class="input-group-text bg-white border-0"><i class="bi bi-search text-secondary"></i></span>
              <input type="search" class="form-control border-0 shadow-none" id="search-expedientes" placeholder="Buscar expedientes..." autocomplete="off">
            </div>
          </div>
          <button type="button" class="btn btn-link text-secondary p-2 d-none d-sm-inline-block" title="Notificaciones"><i class="bi bi-bell fs-5"></i></button>
          <button type="button" class="btn btn-link text-secondary p-2 d-none d-sm-inline-block" title="Ajustes"><i class="bi bi-gear fs-5"></i></button>
          <div class="avatar-placeholder flex-shrink-0" role="img" aria-label="Usuario"></div>
        </div>
      </header>

      <div class="flex-grow-1 p-3 p-md-4">
        <div id="global-alert" class="alert d-none mb-3" role="alert"></div>

        <!-- Vista: formulario (mismos campos que el flujo original → columnas de schema.sql) -->
        <section id="view-nueva">
          <div class="mx-auto" style="max-width: 52rem;">
            <div class="d-flex flex-column flex-md-row align-items-start justify-content-between gap-3 mb-4">
              <div>
                <span class="d-block small fw-bold text-uppercase exec-muted mb-1" style="letter-spacing: 0.05em;">Módulo de compras</span>
                <h2 class="h3 fw-bold exec-primary mb-0">Registro de solicitud de compra</h2>
              </div>
              <div class="text-md-end small exec-muted">
                <p class="mb-1">Ref.: <span class="font-monospace fw-bold exec-primary" id="ref-display">PR-2026-0000</span></p>
                <p class="mb-0">Nivel: <span class="fw-semibold exec-primary">Operativo</span></p>
              </div>
            </div>

            <form id="solicitud-form" class="pb-5" novalidate>
              <!-- Proveedor y fechas (layout tipo “bento” del original) -->
              <div class="row g-4 mb-4">
                <div class="col-12 col-lg-7">
                  <div class="bento-cell p-4 h-100">
                    <label class="form-label fw-bold exec-muted small mb-2" for="supplier" style="letter-spacing: 0.02em;">Proveedor</label>
                    <select class="form-select bento-cell-inner py-3" id="supplier" name="supplier_code" required>
                      <option value="">Seleccione un proveedor autorizado…</option>
                    </select>
                    <p class="mt-2 mb-0 text-uppercase exec-muted" style="font-size: 0.65rem; letter-spacing: 0.12em; opacity: 0.85;">Socios aprobados en base de datos</p>
                    <div class="invalid-feedback">Seleccione un proveedor.</div>
                  </div>
                </div>
                <div class="col-12 col-lg-5">
                  <div class="bento-cell p-4 h-100">
                    <div class="row g-3">
                      <div class="col-6">
                        <label class="form-label label-caps mb-1" for="date">Fecha de solicitud</label>
                        <input class="form-control form-control-sm bento-cell-inner py-2" id="date" name="request_date" type="date" required>
                        <div class="invalid-feedback">Requerida.</div>
                      </div>
                      <div class="col-6">
                        <label class="form-label label-caps mb-1" for="delivery_date">Entrega prevista</label>
                        <input class="form-control form-control-sm bento-cell-inner py-2" id="delivery_date" name="delivery_date" type="date" required>
                        <div class="invalid-feedback">Requerida.</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Producto -->
              <div class="bento-cell p-4 p-md-5 mb-4">
                <div class="d-flex align-items-center gap-2 mb-4 exec-primary">
                  <i class="bi bi-box-seam fs-4"></i>
                  <h3 class="h5 fw-bold mb-0">Información del producto</h3>
                </div>
                <div class="mb-4">
                  <label class="form-label fw-bold exec-muted small mb-2" for="description" style="letter-spacing: 0.02em;">Descripción del producto</label>
                  <textarea class="form-control bento-cell-inner py-3" id="description" name="description" rows="3" required placeholder="Especificaciones completas, referencias del fabricante, números de parte…"></textarea>
                  <div class="invalid-feedback">La descripción es obligatoria.</div>
                </div>
                <div class="row g-4">
                  <div class="col-md-4">
                    <label class="form-label fw-bold exec-muted small mb-2" for="quantity">Cantidad</label>
                    <div class="position-relative">
                      <input class="form-control bento-cell-inner py-3 pe-5" id="quantity" name="quantity" type="number" min="1" step="1" placeholder="0" required>
                      <span class="position-absolute top-50 end-0 translate-middle-y me-3 small fw-bold exec-muted">UDS.</span>
                    </div>
                    <div class="invalid-feedback">Cantidad mínima 1.</div>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label fw-bold exec-muted small mb-2" for="unit_price">Precio unitario</label>
                    <div class="position-relative">
                      <span class="position-absolute top-50 start-0 translate-middle-y ms-3 small fw-bold exec-muted">$</span>
                      <input class="form-control bento-cell-inner py-3 ps-4" id="unit_price" name="unit_price" type="number" min="0" step="0.01" placeholder="0.00" required>
                    </div>
                    <div class="invalid-feedback">Precio inválido.</div>
                  </div>
                  <div class="col-md-4">
                    <label class="form-label label-caps mb-1 exec-primary">Costo total calculado</label>
                    <div class="subtotal-box p-3 rounded">
                      <div id="total_cost" class="fs-3 fw-bold exec-primary">$0.00</div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Notas y envío -->
              <div class="row g-4">
                <div class="col-12 col-lg-8">
                  <div class="bento-cell p-4 h-100">
                    <label class="form-label fw-bold exec-muted small mb-2" for="notes" style="letter-spacing: 0.02em;">Notas adicionales</label>
                    <textarea class="form-control bento-cell-inner py-3" id="notes" name="notes" rows="4" placeholder="Motivo, centro de costos o instrucciones especiales…"></textarea>
                  </div>
                </div>
                <div class="col-12 col-lg-4 d-flex flex-column justify-content-end gap-3">
                  <div class="alert alert-primary border-0 d-flex gap-2 small mb-0" style="background: #d5e3fc; color: #3a485b;">
                    <i class="bi bi-info-circle flex-shrink-0 mt-1"></i>
                    <span>Al enviar se registra la solicitud en la base de datos. Revise el historial para ver o eliminar pedidos.</span>
                  </div>
                  <button type="submit" class="btn btn-lg text-white w-100 py-3 fw-bold shadow-sm" id="btn-submit" style="background: #182034;">
                    <span class="spinner-border spinner-border-sm me-2 d-none" id="btn-submit-spinner" role="status"></span>
                    <i class="bi bi-send-fill me-2"></i>Enviar solicitud
                  </button>
                </div>
              </div>
            </form>
          </div>
        </section>

        <!-- Vista: historial de pedidos -->
        <section id="view-historial" class="d-none">
          <div class="section-card">
            <div class="p-3 p-md-4 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-2">
              <div>
                <h2 class="h5 mb-0 fw-bold" style="color: #1a2b56;">Historial de pedidos</h2>
                <p class="small text-secondary mb-0">Órdenes guardadas en MySQL. Puede eliminar registros.</p>
              </div>
              <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-refresh">
                <i class="bi bi-arrow-clockwise me-1"></i>Actualizar
              </button>
            </div>
            <div class="p-0">
              <div id="loading-row" class="p-4 text-center text-secondary d-none">
                <span class="spinner-border spinner-border-sm me-2"></span>Cargando…
              </div>
              <div id="empty-state" class="p-5 text-center text-secondary d-none">
                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                No hay pedidos. Registre uno en <strong>Nueva solicitud</strong>.
              </div>
              <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 d-none" id="tabla-ordenes">
                  <thead class="table-light">
                    <tr>
                      <th>ID</th>
                      <th>Resumen</th>
                      <th>Proveedor</th>
                      <th>Solicitud</th>
                      <th>Entrega</th>
                      <th class="text-end">Subtotal</th>
                      <th class="table-actions">Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="tabla-ordenes-body"></tbody>
                </table>
              </div>
            </div>
          </div>
        </section>

        <!-- Vista: proveedores (MySQL) -->
        <section id="view-proveedores" class="d-none">
          <div class="section-card">
            <div class="p-3 p-md-4 border-bottom">
              <h2 class="h5 mb-0 fw-bold" style="color: #1a2b56;">Proveedores autorizados</h2>
              <p class="small text-secondary mb-0">Listado desde la tabla <code>suppliers</code>.</p>
            </div>
            <div class="p-0">
              <div id="prov-loading" class="p-4 text-center text-secondary d-none">
                <span class="spinner-border spinner-border-sm me-2"></span>Cargando proveedores…
              </div>
              <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 d-none" id="tabla-proveedores">
                  <thead class="table-light">
                    <tr>
                      <th>Código</th>
                      <th>Nombre</th>
                    </tr>
                  </thead>
                  <tbody id="tabla-proveedores-body"></tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script>
    (function ($) {
      'use strict';

      var API_ORDENES = 'api/solicitudes.php';
      var API_PROV = 'api/suppliers.php';
      var currentView = 'nueva';
      var lastOrdenes = [];

      function descSummary(desc) {
        if (!desc) return '—';
        var s = String(desc).trim().split('\n')[0];
        if (s.length > 72) return s.slice(0, 69) + '…';
        return s;
      }

      function showAlert(type, message) {
        var $el = $('#global-alert');
        $el.removeClass('d-none alert-success alert-danger alert-warning alert-info')
          .addClass('alert-' + type)
          .text(message);
      }

      function hideAlert() {
        $('#global-alert').addClass('d-none').text('');
      }

      function apiErrorText(xhr, fallback) {
        if (xhr.status === 0) {
          return 'No hay respuesta del servidor (URL incorrecta, CORS o sin red). Comprueba que abres el sitio por Apache (http://...) y no como archivo.';
        }
        var j = xhr.responseJSON;
        if (j && j.error) {
          var m = j.error.message || fallback;
          var d = j.error.details;
          if (d && typeof d === 'object' && d.exception) {
            m += ' — ' + d.exception;
          }
          return m;
        }
        if (xhr.status === 404) {
          return 'No se encontró la API (404). La ruta debe ser carpeta del proyecto + api/solicitudes.php';
        }
        if (xhr.responseText && xhr.responseText.indexOf('<') === 0) {
          return fallback + ' (el servidor devolvió HTML en lugar de JSON: suele ser un error de PHP antes del script).';
        }
        return fallback;
      }

      function toNumber(v) {
        if (v === null || v === undefined) return NaN;
        return Number(String(v).trim().replace(',', '.'));
      }

      function formatMoney(n) {
        var x = Number(n);
        if (!Number.isFinite(x)) return '$0.00';
        return x.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2, style: 'currency', currency: 'USD' });
      }

      function formatDate(iso) {
        if (!iso) return '—';
        var d = new Date(iso + 'T12:00:00');
        if (Number.isNaN(d.getTime())) return iso;
        return d.toLocaleDateString('es-MX', { day: '2-digit', month: '2-digit', year: 'numeric' });
      }

      function setDatesDefaults() {
        var t = new Date();
        var y = t.getFullYear();
        var m = String(t.getMonth() + 1).padStart(2, '0');
        var da = String(t.getDate()).padStart(2, '0');
        var iso = y + '-' + m + '-' + da;
        if (!$('#date').val()) $('#date').val(iso);
        if (!$('#delivery_date').val()) $('#delivery_date').val(iso);
      }

      function updateTotal() {
        var qty = toNumber($('#quantity').val());
        var price = toNumber($('#unit_price').val());
        if (!Number.isFinite(qty) || !Number.isFinite(price) || qty < 0 || price < 0) {
          $('#total_cost').text('$0.00');
          return;
        }
        $('#total_cost').text(formatMoney(qty * price));
      }

      function showView(name) {
        currentView = name;
        $('#view-nueva, #view-historial, #view-proveedores').addClass('d-none');
        $('#view-' + name).removeClass('d-none');
        $('.nav-stratos .nav-link[data-view]').removeClass('active');
        $('.nav-stratos .nav-link[data-view="' + name + '"]').addClass('active');

        var titles = {
          nueva: 'Nueva solicitud de compra',
          historial: 'Historial de pedidos',
          proveedores: 'Proveedores'
        };
        $('#page-title').text(titles[name] || '');

        if (name === 'historial') {
          loadOrdenes();
          $('#search-expedientes').attr('placeholder', 'Buscar en pedidos…');
        } else if (name === 'proveedores') {
          loadProveedores();
          $('#search-expedientes').attr('placeholder', 'Buscar proveedores…');
        } else {
          $('#search-expedientes').attr('placeholder', 'Buscar expedientes…');
        }
        $('#search-expedientes').val('');
        applySearchFilter();
      }

      $('.nav-stratos .nav-link[data-view]').on('click', function (e) {
        e.preventDefault();
        var v = $(this).data('view');
        if (v) showView(v);
      });

      function setOrdenesLoading(on) {
        if (on) {
          $('#loading-row').removeClass('d-none');
          $('#empty-state').addClass('d-none');
          $('#tabla-ordenes').addClass('d-none');
        } else {
          $('#loading-row').addClass('d-none');
        }
      }

      function renderOrdenRows(items) {
        lastOrdenes = items || [];
        var $tbody = $('#tabla-ordenes-body');
        $tbody.empty();
        var filtered = filterOrdenesBySearch(lastOrdenes, $('#search-expedientes').val());

        if (!filtered.length) {
          $('#tabla-ordenes').addClass('d-none');
          if (lastOrdenes.length) {
            $('#empty-state').addClass('d-none');
            $('#tabla-ordenes').removeClass('d-none');
            $tbody.append($('<tr>').append($('<td colspan="7" class="text-center text-secondary py-4">').text('Ningún resultado para la búsqueda.')));
          } else {
            $('#empty-state').removeClass('d-none');
          }
          return;
        }

        $('#empty-state').addClass('d-none');
        $('#tabla-ordenes').removeClass('d-none');

        filtered.forEach(function (row) {
          var id = row.id;
          var prod = descSummary(row.description);
          var prov = row.supplier_name || row.supplier_code || '—';
          var haystack = (
            String(id) + ' ' +
            String(row.description || '') + ' ' +
            String(row.notes || '') + ' ' +
            prov
          ).toLowerCase();
          var tr = $('<tr>').addClass('orden-row').attr('data-search', haystack);
          tr.append($('<td>').text(id));
          tr.append($('<td>').text(prod));
          tr.append($('<td>').text(prov));
          tr.append($('<td>').text(formatDate(row.request_date)));
          tr.append($('<td>').text(formatDate(row.delivery_date)));
          tr.append($('<td class="text-end">').text(formatMoney(row.total_cost)));
          var $btn = $('<button type="button" class="btn btn-sm btn-outline-danger btn-eliminar">Eliminar</button>');
          $btn.data('id', id);
          tr.append($('<td class="table-actions">').append($btn));
          $tbody.append(tr);
        });
      }

      function filterOrdenesBySearch(items, q) {
        if (!q || !String(q).trim()) return items;
        var needle = String(q).trim().toLowerCase();
        return items.filter(function (row) {
          var hay = (
            String(row.id) + ' ' +
            (row.description || '') + ' ' +
            (row.notes || '') + ' ' +
            (row.supplier_name || '') + ' ' +
            (row.supplier_code || '')
          ).toLowerCase();
          return hay.indexOf(needle) !== -1;
        });
      }

      function applySearchFilter() {
        if (currentView === 'historial') {
          renderOrdenRows(lastOrdenes);
        } else if (currentView === 'proveedores') {
          filterProveedoresTable($('#search-expedientes').val());
        }
      }

      function loadOrdenes() {
        hideAlert();
        setOrdenesLoading(true);
        $.ajax({ url: API_ORDENES, method: 'GET', dataType: 'json' })
          .done(function (res) {
            if (!res || !res.ok) {
              showAlert('danger', (res && res.error && res.error.message) || 'No se pudieron cargar los pedidos.');
              renderOrdenRows([]);
              return;
            }
            renderOrdenRows(res.data || []);
          })
          .fail(function (xhr) {
            showAlert('danger', apiErrorText(xhr, 'Error al cargar pedidos.'));
            renderOrdenRows([]);
          })
          .always(function () {
            setOrdenesLoading(false);
          });
      }

      function eliminarOrden(id) {
        if (!window.confirm('¿Eliminar el pedido #' + id + '? Esta acción no se puede deshacer.')) return;
        $.ajax({
          url: API_ORDENES,
          method: 'DELETE',
          contentType: 'application/json; charset=utf-8',
          data: JSON.stringify({ id: id }),
          dataType: 'json'
        }).done(function (res) {
          if (!res || !res.ok) {
            showAlert('danger', (res && res.error && res.error.message) || 'No se pudo eliminar.');
            return;
          }
          showAlert('success', 'Pedido #' + id + ' eliminado.');
          loadOrdenes();
        }).fail(function (xhr) {
          showAlert('danger', apiErrorText(xhr, 'Error al eliminar.'));
        });
      }

      var lastProveedores = [];

      function loadProveedores() {
        $('#prov-loading').removeClass('d-none');
        $('#tabla-proveedores').addClass('d-none');
        $.ajax({ url: API_PROV, method: 'GET', dataType: 'json' })
          .done(function (res) {
            if (!res || !res.ok) {
              showAlert('danger', (res && res.error && res.error.message) || 'No se pudieron cargar los proveedores.');
              lastProveedores = [];
              renderProveedores([]);
              return;
            }
            lastProveedores = res.data || [];
            renderProveedores(lastProveedores);
          })
          .fail(function (xhr) {
            showAlert('danger', apiErrorText(xhr, 'Error al cargar proveedores.'));
            lastProveedores = [];
            renderProveedores([]);
          })
          .always(function () {
            $('#prov-loading').addClass('d-none');
          });
      }

      function renderProveedores(list) {
        var $tb = $('#tabla-proveedores-body');
        $tb.empty();
        if (!list.length) {
          $('#tabla-proveedores').addClass('d-none');
          return;
        }
        $('#tabla-proveedores').removeClass('d-none');
        list.forEach(function (p) {
          var tr = $('<tr>').addClass('prov-row').attr('data-search', (p.code + ' ' + p.name).toLowerCase());
          tr.append($('<td>').append($('<code>').text(p.code)));
          tr.append($('<td>').text(p.name));
          $tb.append(tr);
        });
        filterProveedoresTable($('#search-expedientes').val());
      }

      function filterProveedoresTable(q) {
        if (!lastProveedores.length) return;
        var needle = (q || '').trim().toLowerCase();
        $('.prov-row').each(function () {
          var show = !needle || ($(this).attr('data-search') || '').indexOf(needle) !== -1;
          $(this).toggleClass('d-none', !show);
        });
      }

      function fillSupplierSelect() {
        $.ajax({ url: API_PROV, method: 'GET', dataType: 'json' })
          .done(function (res) {
            var $sel = $('#supplier');
            var keep = $sel.val();
            $sel.find('option:not(:first)').remove();
            if (res && res.ok && res.data) {
              res.data.forEach(function (p) {
                $sel.append($('<option>').val(p.code).text(p.name));
              });
            }
            if (keep) $sel.val(keep);
          });
      }

      $('#search-expedientes').on('input', applySearchFilter);

      $('#quantity, #unit_price').on('input change', updateTotal);
      updateTotal();

      $('#btn-refresh').on('click', function () {
        loadOrdenes();
      });

      $('#tabla-ordenes-body').on('click', '.btn-eliminar', function () {
        var id = $(this).data('id');
        if (id) eliminarOrden(Number(id));
      });

      $('#solicitud-form').on('submit', function (e) {
        e.preventDefault();
        hideAlert();

        var form = this;
        if (!form.checkValidity()) {
          e.stopPropagation();
          $(form).addClass('was-validated');
          return;
        }

        var payload = {
          supplier_code: $('#supplier').val() || '',
          request_date: $('#date').val() || '',
          delivery_date: $('#delivery_date').val() || '',
          description: $('#description').val() || '',
          quantity: toNumber($('#quantity').val()),
          unit_price: toNumber($('#unit_price').val()),
          notes: $('#notes').val() || ''
        };

        var $btn = $('#btn-submit');
        var $spin = $('#btn-submit-spinner');
        $btn.prop('disabled', true);
        $spin.removeClass('d-none');

        $.ajax({
          url: API_ORDENES,
          method: 'POST',
          contentType: 'application/json; charset=utf-8',
          data: JSON.stringify(payload),
          dataType: 'json'
        }).done(function (res) {
          if (!res || !res.ok) {
            var base = (res && res.error && res.error.message) || 'Error al registrar.';
            var det = res && res.error && res.error.details;
            if (det && typeof det === 'object') {
              base += ' ' + $.map(det, function (v, k) { return k + ': ' + v; }).join(' · ');
            }
            showAlert('danger', base);
            return;
          }
          var newId = res.data && res.data.id;
          showAlert('success', 'Solicitud registrada' + (newId ? ' (ID: ' + newId + ').' : '.'));
          if (newId) {
            $('#ref-display').text('PR-2026-' + String(newId).padStart(4, '0'));
          }
          form.reset();
          $(form).removeClass('was-validated');
          setDatesDefaults();
          updateTotal();
          if (currentView === 'historial') loadOrdenes();
        }).fail(function (xhr) {
          showAlert('danger', apiErrorText(xhr, 'Error al registrar la solicitud.'));
        }).always(function () {
          $btn.prop('disabled', false);
          $spin.addClass('d-none');
        });
      });

      $(function () {
        setDatesDefaults();
        fillSupplierSelect();
        showView('nueva');
      });
    })(jQuery);
  </script>
</body>
</html>
