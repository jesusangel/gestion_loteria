<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

if (!Configure::read('debug')):
	throw new NotFoundException();
endif;

App::uses('Debugger', 'Utility');
?>
<h2><?php echo __d('cake_dev', 'Versión de CakePHP %s.', Configure::version()); ?></h2>
<p>
	<a href="http://cakephp.org/changelogs/<?php echo Configure::version(); ?>"><?php echo __d('cake_dev', 'Notas de la versión'); ?> </a>
</p>
<?php
if (Configure::read('debug') > 0):
	Debugger::checkSecurityKeys();
endif;
?>
<p id="url-rewriting-warning" style="background-color:#e32; color:#fff;">
	<?php echo __d('cake_dev', 'URL rewriting is not properly configured on your server.'); ?>
	1) <a target="_blank" href="http://book.cakephp.org/2.0/en/installation/url-rewriting.html" style="color:#fff;">Help me configure it</a>
	2) <a target="_blank" href="http://book.cakephp.org/2.0/en/development/configuration.html#cakephp-core-configuration" style="color:#fff;">I don't / can't use URL rewriting</a>
</p>
<p>
<?php
	if (version_compare(PHP_VERSION, '5.2.8', '>=')):
		echo '<span class="notice success">';
			echo __d('cake_dev', 'Su versión de PHP es 5.2.8 o superior.');
		echo '</span>';
	else:
		echo '<span class="notice">';
			echo __d('cake_dev', 'Su versión de PHP es demasiado baja. Necesita al menos PHP 5.2.8 o superior para usar esta aplicación.');
		echo '</span>';
	endif;
?>
</p>
<p>
	<?php
		if (is_writable(TMP)):
			echo '<span class="notice success">';
				echo __d('cake_dev', 'Se puede escribir en el directorio temporal.');
			echo '</span>';
		else:
			echo '<span class="notice">';
				echo __d('cake_dev', 'No es posible escribir en el directorio temporal.');
			echo '</span>';
		endif;
	?>
</p>
<p>
	<?php
		$settings = Cache::settings();
		if (!empty($settings)):
			echo '<span class="notice success">';
				echo __d('cake_dev', 'El motor %s se está usando para la caché del núcleo. Para cambiarlo, edite APP/Config/core.php ', '<em>'. $settings['engine'] . 'Engine</em>');
			echo '</span>';
		else:
			echo '<span class="notice">';
				echo __d('cake_dev', 'La caché no está funcionando.. Por favor, compruebe la configuración en APP/Config/core.php');
			echo '</span>';
		endif;
	?>
</p>
<p>
	<?php
		$filePresent = null;
		if (file_exists(APP . 'Config' . DS . 'database.php')):
			echo '<span class="notice success">';
				echo __d('cake_dev', 'El archivo de configuración de la base de datos existe.');
				$filePresent = true;
			echo '</span>';
		else:
			echo '<span class="notice">';
				echo __d('cake_dev', 'El archivo de configuración de la base de datos no existe.');
				echo '<br/>';
				echo __d('cake_dev', 'Cambie el nombre de APP/Config/database.php.default a APP/Config/database.php');
			echo '</span>';
		endif;
	?>
</p>
<?php
if (isset($filePresent)):
	App::uses('ConnectionManager', 'Model');
	try {
		$connected = ConnectionManager::getDataSource('default');
	} catch (Exception $connectionError) {
		$connected = false;
		$errorMsg = $connectionError->getMessage();
		if (method_exists($connectionError, 'getAttributes')) {
			$attributes = $connectionError->getAttributes();
			if (isset($errorMsg['message'])) {
				$errorMsg .= '<br />' . $attributes['message'];
			}
		}
	}
?>
<p>
	<?php
		if ($connected && $connected->isConnected()):
			echo '<span class="notice success">';
				echo __d('cake_dev', 'La aplicación puede conectarse a la base de datos.');
			echo '</span>';
		else:
			echo '<span class="notice">';
				echo __d('cake_dev', 'La aplicación no puede conectarse con la base de datos.');
				echo '<br /><br />';
				echo $errorMsg;
			echo '</span>';
		endif;
	?>
</p>
<?php endif; ?>
<?php
	App::uses('Validation', 'Utility');
	if (!Validation::alphaNumeric('cakephp')) {
		echo '<p><span class="notice">';
			echo __d('cake_dev', 'PCRE no ha sido compilado con soporte Unicode.');
			echo '<br/>';
			echo __d('cake_dev', 'Recompile PCRE con soporte para Unicode añadiendo <code>--enable-unicode-properties</code> cuando lo configure');
		echo '</span></p>';
	}
?>

<p>
	<?php
		if (CakePlugin::loaded('DebugKit')):
			echo '<span class="notice success">';
				echo __d('cake_dev', 'El plugin DebugKit está instalado');
			echo '</span>';
		else:
			echo '<span class="notice">';
				echo __d('cake_dev', 'DebugKit no está instalado.');
			echo '</span>';
		endif;
	?>
</p>