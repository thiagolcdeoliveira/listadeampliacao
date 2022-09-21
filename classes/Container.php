<?php

class Container {
	public static function getBanco(){
		return new Banco('localhost', 'listadeaplicacao', 'lista', 'lista');
	}
}
