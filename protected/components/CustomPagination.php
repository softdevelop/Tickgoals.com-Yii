<?php

class CustomPagination extends CLinkPager{

	public function init() {
		parent::init();

	}
	protected function createPageButton($label,$page,$class,$hidden,$selected){
		$check = 'yes';
		if($hidden || $selected){
			$check = 'no';
			$class.=' '.($hidden ? self::CSS_HIDDEN_PAGE : self::CSS_SELECTED_PAGE);
		}
		if($check=='no'){
			switch($label){
				case "<<":
					return '<span class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($page)).'</span>';
				break;
				case "<":
					return '<span class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($page)).'</span>';
				break;
				case ">>":
					return '<span class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($page)).'</span>';
				break;
				case ">":
					return '<span class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($page)).'</span>';
				break;
				default:
					return '<span class="'.$class.'">'.$label.'</span>';
				break;
			}

				
		}else{
			return '<span class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($page)).'</span>';
		}
		
		
	}
}
