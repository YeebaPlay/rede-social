<?php 
	// Funчуo para limitar texto e adicionar 3 pontinhos no final.
	function resumir($var, $limite)
	{
		// Se o texto for maior que o limite, ele corta o texto e adiciona 3 pontinhos.
		if (strlen($var) > $limite){
			echo substr_replace ($var, '...', $limite);
		}
		else
		{
			// Se nуo for maior que o limite, ele nуo adiciona nada.
			echo substr_replace ($var, '', $limite);
		}
	}

?>