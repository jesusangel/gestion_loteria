<?php

/**
 * 
 * Enter description here ...
 * @author jpozdom
 *
 */
class SorteoNoEncontradoException extends NotFoundException {

/**
 * Constructor
 *
 * @param string $message If no message is given 'Not Found' will be the message
 * @param int $code Status code, defaults to 404
 */
	public function __construct($message = null, $code = 404) {
		if (empty($message)) {
			$message = __('Sorteo no válido');
		}
		parent::__construct($message, $code);
	}

}

/**
 * 
 * Enter description here ...
 * @author jpozdom
 *
 */
class SorteoCelebradoException extends NotFoundException {

/**
 * Constructor
 *
 * @param string $message If no message is given 'Not Found' will be the message
 * @param int $code Status code, defaults to 404
 */
	public function __construct($message = null, $code = 404) {
		if (empty($message)) {
			$message = __('El sorteo ya se ha celebrado');
		}
		parent::__construct($message, $code);
	}

}

/**
 * 
 * Enter description here ...
 * @author jpozdom
 *
 */
class DecimoAjenoException extends UnexpectedValueException {

/**
 * Constructor
 *
 * @param string $message If no message is given 'Not Found' will be the message
 * @param int $code Status code, defaults to 404
 */
	public function __construct($message = null, $code = 404) {
		if (empty($message)) {
			$message = __('El décimo escaneado no pertenece a este sorteo');
		}
		parent::__construct($message, $code);
	}

}