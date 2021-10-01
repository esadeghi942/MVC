<?php
namespace Models;

//I Change Name Class From Answer To Bnswer because it extend BaseModel and get Error for Answer Name
class Bnswer extends BaseModel
{
    const table='answers',
     primary='answer_id',
     timecreate='answer_create';

    public function delete()
    {
        $Qb = QB::getInstance();
        $i = $Qb->delete($this::table)->where($this::primary,$this->id)->exec();
        if ($i)
            return true;
        return false;
    }
}