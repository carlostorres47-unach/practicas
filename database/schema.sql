-- Esquema base para "Solicitud de Compra"
-- Recomendado: ejecuta este script en tu MySQL (phpMyAdmin / cliente MySQL).

CREATE DATABASE IF NOT EXISTS stitch
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_unicode_ci;

USE stitch;

CREATE TABLE IF NOT EXISTS suppliers (
  code VARCHAR(64) NOT NULL,
  name VARCHAR(255) NOT NULL,
  PRIMARY KEY (code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO suppliers (code, name) VALUES
  ('global_logistics', 'Global Logistics Corp'),
  ('nexus_tech', 'Nexus Technology Solutions'),
  ('precision_parts', 'Precision Parts Ltd'),
  ('industrial_supply', 'Industrial Supply Group')
ON DUPLICATE KEY UPDATE
  name = VALUES(name);

CREATE TABLE IF NOT EXISTS solicitudes_compra (
  id INT NOT NULL AUTO_INCREMENT,
  supplier_code VARCHAR(64) NOT NULL,
  request_date DATE NOT NULL,
  delivery_date DATE NOT NULL,
  description TEXT NOT NULL,
  quantity INT NOT NULL,
  unit_price DECIMAL(10,2) NOT NULL,
  total_cost DECIMAL(12,2) NOT NULL,
  notes TEXT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_supplier_code (supplier_code),
  KEY idx_request_date (request_date),
  KEY idx_created_at (created_at),
  CONSTRAINT fk_solicitudes_supplier FOREIGN KEY (supplier_code)
    REFERENCES suppliers(code)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
