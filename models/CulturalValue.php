<?php

class CulturalValue{

    public static function getAllCulturalValues($db){
        $query='SELECT * FROM cultural_values';
        return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);    
    }

    public static function createCulturalValue($db,$cv){
        $query='INSERT INTO cultural_values(value_name) VALUES(:cv)';
        $stmt=$db->prepare($query);
        return $stmt->execute(['cv'=>$cv]);
    }

    public static function deleteCulturalValue($db,$id){
        $query='DELETE FROM cultural_values WHERE id=:id';
        $stmt=$db->prepare($query);
        return $stmt->execute(['id'=>$id]);
    }

}

?>