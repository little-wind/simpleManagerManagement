<?php
  class Model {
    protected function getOne($sql) {
      $dbc = DB::getDB();
      $result = $dbc->query($sql);
      $objects = $result->fetch_object();
      DB::unDB($result, $dbc);
      return $objects;
    }

    protected function getAll($sql) {
      $dbc = DB::getDB();
      $result = $dbc->query($sql);
      $html = array();
      while($objects = $result->fetch_object()) {
        $html[] = $objects;
      }
      DB::unDB($result, $dbc);
      return $html;
    }

    protected function aud($sql) {
      $dbc = DB::getDB();
      $dbc->query($sql);
      $affected_rows = $dbc->affected_rows;
      DB::unDB($result, $dbc);
      return $affected_rows;
    }
  }
?>