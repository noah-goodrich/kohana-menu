<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Represents a single Menu type HTML entity
 */
class Kohana_Menu {

	/**
	 * @var array Current menu config file
	 */
	protected $_config;

	/**
	 * @var View Current menu view
	 */
	protected $_view;

	/**
	 * @var array An (ordered) array of Menu_Items in this menu
	 * @since 2.0
	 */
	protected $_items;

	/**
	 * @var Menu_Item Reference to the currently active menu item
	 */
	protected $_active_item;

	/**
	 * @param string $config The name of the menu config file in config/menu/ dir
	 * @see self::factory
	 */
	public function __construct($config = 'bootstrap')
	{
		$this->_config = Kohana::$config->load($config);
		$this->_view = View::factory($this->_config['view']);

		foreach ($this->_config['items'] as $key => $item) {
			$this->_items[$key] = new Menu_Item($item, $this);
		}
	}

	/**
	 * @param string $config The config file that contains the menu array
	 * @throws Kohana_Exception
	 * @return Menu
	 */
	public static function factory($config = 'bootstrap')
	{
		if (Kohana::find_file('config/menu', $config) === FALSE) {
			throw new Kohana_Exception('Menu configuration file ":path" not found!', [':path'=> APPPATH.'config/menu/'.$config
				.EXT
			]);
		}
		return new Menu('menu/'.$config);
	}

	/**
	 * @return    string    the rendered view
	 */
	public function render()
	{
		return $this->_view
			->set('menu', $this)
			->render();
	}

	/**
	 * @since 1.0
	 * @see render()
	 * @return string
	 */
	public function __toString()
	{
		// Try to guess the current active menu item
		if (array_key_exists('auto_mark_current', $this->_config) && $this->_config['auto_mark_current']) {
			$this->set_current(Request::current()->uri());
		}

		return $this->render();
	}

	/**
	 * @since 2.0
	 * @return array
	 */
	public function get_items()
	{
		return $this->_items;
	}

	/**
	 * @since 2.0
	 * @param int|string $id The ID of the menu (numerical array ID from the config file) or URL of a menu item
	 * @return Menu_Item|bool The active menu item or FALSE when item not found
	 */
	public function set_current($id = 0)
	{
		$item = NULL;

		// Menu empty!
		if (count($this->_items) === 0) {
			return FALSE;
		}

		if (is_int($id)) { // By ID
			if (array_key_exists($id, $this->_items)) {
				$item = $this->_items[$id];
			}
		} else { // By URL
			foreach ($this->_items as $menu_item) {
				if ($menu_item->url === $id) {
					$item = $menu_item;
				}
			}
		}

		// Set item as active
		if ($item instanceof Menu_Item) { // Item found in the menu

			// Unset old active item
			if ($this->_active_item instanceof Menu_Item) {
				$this->_active_item->remove_class($this->_config['current_class']);
			}
			return $this->_active_item = $item->add_class($this->_config['current_class']);
		}

		return FALSE;
	}
}