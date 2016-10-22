<?php

namespace packs\ActiveRecord;

/**
 * @author farZa
 */
interface IActiveRecord
{
    public function findOne(array $condition = []);
    public function findAll(array $condition = []):array;
    public function save():bool;
    public function remove():bool;
}
