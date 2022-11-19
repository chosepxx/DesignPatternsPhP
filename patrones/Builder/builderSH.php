<?php 
 
class RegistroPintura {
    
    private $brand;
    private $machineCapacity;
    private $machineType;
    private $mileage;

    public function __construct($brand, $machineCapacity,$machineType, $mileage){
        $this->brand = $brand;
        $this->machineCapacity = $machineCapacity;
        $this->machineType = $machineType;
        $this->mileage = $mileage;
    }

    public function getMileAge(){
        return $this->mileage;
    }

    public function getmachineCapacity(){
        return $this->machineCapacity;
    }

    public function getMachineType(){
        return $this->machineType;
    }

    public function getBrand(){
        return $this->brand;
    }

    public function setBrand($brand){
        if(null !== $brand){
            $this->brand = $brand;
            return "Brand Saved Succesfully";
        }else{
            return "You need to enter the brand name";
        }
    }

    public function addMileage($mileage){
        $this->mileage += $mileage;
    }

}