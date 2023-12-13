<?php
function mostrarAlerta($tipo, $titulo, $contenido, $atributos = []) {
  $html = '<div class="alert alert-' . $tipo . ' alert-dismissible" role="alert">
              <strong>' . $titulo . '</strong>
              ' . $contenido . '
          </div>';

  if ($atributos) {
      foreach ($atributos as $key => $value) {
          $html .= ' ' . $key . '="' . $value . '" ';
      }
  }

  return $html;
}

class Alerta {

  public $tipo;
  public $titulo;
  public $contenido;

  public function __construct($tipo, $titulo, $contenido) {
      $this->tipo = $tipo;
      $this->titulo = $titulo;
      $this->contenido = $contenido;
  }

  public function mostrar() {
      echo mostrarAlerta($this->tipo, $this->titulo, $this->contenido);
  }
}
?>
