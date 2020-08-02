<?php
/*
* 2007-2020 PrestaShop SA and Contributors
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2020 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
* PrestaShop Webservice Library
* @package PrestaShopWebservice
*/

// Here we define constants /!\ You need to replace this parameters
define('DEBUG', false);											// Debug mode
define('PS_SHOP_PATH', 'http://impotec.cl/');							// Root path of your PrestaShop store
define('PS_WS_AUTH_KEY', 'XLWMHFNQXG1W5JTQ9MWY5A47WTJ9FYCT');	// Auth key (Get it in your Back Office)
require_once('PrestaShopwebservice/PSWebServiceLibrary.php');

// Here we make the WebService Call
try
{
	$webService = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
	// Here we set the option array for the Webservice : we want customers resources
//	$opt['resource'] = 'order_payments';
	$opt = array(
        'resource' => 'orders',
        'display' => 'full',
        'sort' => '[id_DESC]',
        
        'limit' => 100,
        'output_format'=>'JSON',
	);
//	$webService2 = new PrestaShopWebservice(PS_SHOP_PATH, PS_WS_AUTH_KEY, DEBUG);
	// Here we set the option array for the Webservice : we want customers resources
//	$opt['resource'] = 'order_payments';
	$opt2 = array(
        'resource' => 'address',
        
    );
	// We set an id if we want to retrieve infos from a customer
	if (isset($_GET['id']))
		$opt['id'] = (int)$_GET['id']; // cast string => int for security measures

	// Call
	$xml = $webService->get($opt);
	//$xml2 = $webService2->get($opt2);
	// Here we get the elements from children of customer markup which is children of prestashop root markup$order_array = $xml->orders->order->children();
	//$resources = $xml->children()->children();
   // $resources = $xml-> children()->children();
    
}
catch (PrestaShopWebserviceException $e)
{
	// Here we are dealing with errors
	$trace = $e->getTrace();
	if ($trace[0]['args'][0] == 404) echo 'Bad ID';
	else if ($trace[0]['args'][0] == 401) echo 'Bad auth key';
	else echo 'Other error<br />'.$e->getMessage();
}

	header('Content-type:application/json');
    echo json_encode($xml,JSON_PRETTY_PRINT);
  // echo $xml->asXML();
  // echo $xml2->asXML();
   //echo "<pre>".htmlentities($xml->asXML())."</pre>";
?>

