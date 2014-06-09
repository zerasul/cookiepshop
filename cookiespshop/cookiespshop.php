<?php
/****************************************************************
 *Modulo CookiesPshop: Este modulo permite mostrar              *
 * un mensaje con las cookies de la web.                        *
 * de esta manera, se cumple con la Ley 34/2002.                *
 * Ley Europea de Cookies.                                      *
 * Autor: IndalWare<Suarez.garcia.victor@gmail.com              *
 * Version 0.1.                                                 *
 * Bajo Licencia Apache:                                        *
 *  http://github.com/zerasul/cookiepshop/blob/master/LICENSE   *
 ****************************************************************/
if (!defined('_PS_VERSION_'))
  exit;
  
class cookiespshop extends Module
{
    public function __construct()
	{
		$this->name = 'cookiespshop';
		$this->tab = 'front_office_features';
		$this->version = 0.1;
		$this->author = 'IndalWare';
		$this->need_instance = 1;

		parent::__construct();
		
		$this->displayName = $this->l('Modulo cookies');
		$this->description = $this->l('modulo para la prueba de cookies');
	}

	public function install()
	{	
		return (parent::install() AND $this->registerHook('displayHeader') AND $this->registerHook('Header'));
	}
	public function hookHeader()
	{
		
	}

	public function hookLeftColumn($params)
	{
		$this->hookDisplayTop($params);
	}
	public function hookDisplayBanner($params)
	{
		$this->hookDisplayTop($params);
	}
	public function hookDisplayHeader($params){
		$this->context->controller->addJS($this->_path.'js/jquery/plugins/jquery.c00k1e.js');
		$this->context->controller->addJS($this->_path.'js/c00k1epsh0p.js');
		

		$politica=Configuration::get('cookiespshop');
		
		//$this->context->$smarty->debug=true;
		//$this->context->$smarty->debug=true;
		$showMessage=(isset($_COOKIE['showMessage']))?1:0;
		$this->context->smarty->assign(array('ckpshop_politica' => $this->l($politica),'showMessage'=>$showMessage));
		
		//echo dirname(__FILE__).'/cookiespshop.tpl';
		return $this->display(__FILE__,'cookiespshop.tpl');
	}

	public function getContent()
{
    $output = null;
 
    if (Tools::isSubmit('submit'.$this->name))
    {
        $my_module_name = strval(Tools::getValue('cookiespshop'));
        if (!$my_module_name
          || empty($my_module_name)
         // || !Validate::isGenericName($my_module_name)
          )
            $output .= $this->displayError($this->l('Invalid Configuration value'));
        else
        {
            Configuration::updateValue('cookiespshop', $my_module_name,true);
            $output .= $this->displayConfirmation($this->l('Settings updated'));
        }
    }
    return $output.$this->displayForm();
}

public function displayForm()
{

 $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
     
    // Init Fields form array
    $fields_form[0]['form'] = array(
        'legend' => array(
            'title' => $this->l('Configuracion'),
        ),
        'input' => array(
            array(
                'type' => 'textarea',
                'label' => $this->l('Politica de Cookies'),
                'name' => 'cookiespshop',
                'rows' => 10,
                'cols' => 50,
                'style' => 'resize:none',
                'autoload_rte' => true,
                'required' => true
            )
        ),
        'submit' => array(
            'title' => $this->l('Save'),
            'class' => 'button'
        )
    );
     
    $helper = new HelperForm();
     
    // Module, token and currentIndex
    $helper->module = $this;
    $helper->name_controller = $this->name;
    $helper->token = Tools::getAdminTokenLite('AdminModules');
    $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
     
    // Language
    $helper->default_form_language = $default_lang;
    $helper->allow_employee_form_lang = $default_lang;
     
    // Title and toolbar
    $helper->title = $this->displayName;
    $helper->show_toolbar = true;        // false -> remove toolbar
    $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
    $helper->submit_action = 'submit'.$this->name;
    $helper->toolbar_btn = array(
        'save' =>
        array(
            'desc' => $this->l('Save'),
            'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
            '&token='.Tools::getAdminTokenLite('AdminModules'),
        ),
        'back' => array(
            'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
            'desc' => $this->l('Back to list')
        )
    );
     
    // Load current value
    $helper->fields_value['cookiespshop'] = Configuration::get('cookiespshop');
     
    return $helper->generateForm($fields_form);


}
	

}