<?php
class ControllerTestTest extends Controller {
	public function index()
    {
        //deb - функция для отладки (выводит значения в удобной форме)
		function deb($str)
		{
			echo '<pre>';
			var_dump($str);
			//print_r($str);
			echo '</pre>';
		}

		//Начало хлебных крошек
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
        //Конец хлебных крошек

        //Подключение модели category в папке catalog
		$this->load->model('catalog/category');
        //Вызов функции модели. Здесь, здесь: получение всех категорий
		$categories = $this->model_catalog_category->getCategories($parent_id=0);
		// Подключение модели product в папке catalog
		$this->load->model('catalog/product');

        //Ассоц. массив, в который будут сохранены продукты с разбивкой по категориям
        $products = [];
        foreach ($categories as $category){
            $categoryProducts = [];
            //Массив настроек выборки продуктов текущей категории
            $categoryProducts['filter_category_id'] = $category['category_id'];
            //Получение продуктов текущей категории
            $products[$category['category_id']] = $this->model_catalog_product->getProducts($categoryProducts);
        }

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		// Массив Data (пример обьявления переменной для отправки в вид)
		$data['categories'] = $categories;

		//$this->response->setOutput($this->load->view('test/test', $data));

        // Массив Data (пример обьявления переменной для отправки в вид)
		$data['products'] = $products;

		//Отправка данных в вид
		$this->response->setOutput($this->load->view('test/test', $data));
	}
}

