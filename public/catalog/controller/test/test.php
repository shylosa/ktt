<?php
class ControllerTestTest extends Controller {
	public function index() {
		function deb($str)
		{
			echo '<pre>';
			var_dump($str);
			echo '</pre>';
		}

		function show_table($table_data){
			echo '<table>';
			foreach ($table_data as $key => $value) {
				
			}
			echo '</table>';
		}

		//deb - функция для отладки ( выводит значения в удобной форме)
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$url = '';
		
		$data['breadcrumbs'][] = array(
			'text' => 'Test',
			'href' => $this->url->link('test/test')
		);

		$this->load->model('catalog/category'); // подключение модели category в папке catalog
		$categories = $this->model_catalog_category->getCategories($parent_id=0); // так вызывается функция модели

		$this->load->model('catalog/product'); // подключение модели product в папке catalog
		$products_all = $this->model_catalog_product->getProducts();

		//deb($products_all); die();
	
		//Подключить модель product и вызвать метод для получения товаров категории

		// пример вызова функции для отладки		 
		//deb($categories);	

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');


		foreach ($category as $categories) {
			$category = $this->model_catalog_product->getProducts();
		}
		
		// Массив Data (пример обьявления переменной для отправки в вид)
		$data['categories'] = $categories;

		//$this->response->setOutput($this->load->view('test/test', $data));

				// Массив Data (пример обьявления переменной для отправки в вид)
		$data['products'] = $products_all;
		//$data = '';
		//foreach ($products_all as $key => $value) {
		//	$data = $key. '-' . $value;
		//}


		$this->response->setOutput($this->load->view('test/test', $data));
	// 	$this->response->setOutput($this->load->view('test/test',
	// 		'products'=> $products_all,
	// 		'categories' => $categories	
	// 	));
	}
}

