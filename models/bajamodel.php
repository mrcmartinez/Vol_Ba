<?php
include_once 'models/bajas.php';
class BajaModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function get($id)
    {
        $items = [];
        $query = $this->db->connect()->prepare("SELECT*FROM documentacion WHERE id_personal = :id_personal");
        try {
            $query->execute(['id_personal' => $id]);
            while ($row = $query->fetch()) {
                $item = new Documentos();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->descripcion = $row['descripcion'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
    public function getAll()
    {
        $items = [];
        try {
            $query = $this->db->connect()->query('SELECT * FROM bajas');

            while ($row = $query->fetch()) {
                $item = new Bajas();
                $item->id_personal = $row['id_personal'];
                $item->fecha = $row['fecha'];
                $item->motivo = $row['motivo'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function getBusqueda($c)
    {
        $items = [];
        try {
            $query = $this->db->connect()->query("SELECT * FROM documentacion WHERE (id_personal like '%" . $c . "%' OR nombre like '%" . $c . "%')");
            while ($row = $query->fetch()) {
                $item = new Documentos();
                $item->id_personal = $row['id_personal'];
                $item->nombre = $row['nombre'];
                $item->descripcion = $row['descripcion'];
                $item->estatus = $row['estatus'];
                array_push($items, $item);
            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }
    }
}