<?php

namespace App\Controllers;

class Product extends BaseController
{
        protected $product_kinds = array(
                'shirt',
                'mug',
                'face_mask'
        );

        public function index()
        {
                $params = [];
                $code = $this->request->getVar('code');
                $kind = $this->request->getVar('kind');
                $shop_type = $this->request->getVar('shop_type');
                
                if ($code) {
                        $params[] = "code = '{$code}'";
                }

                if ($shop_type) {
                        $params[] = "shop_type = '{$shop_type}'";
                }

                // Create a new class manually
                $productModel = new \App\Models\ProductModel();
                $results = $productModel->getAll($params);

                $pageName = "Making Product";
                $showMenu = 'product';
                $product_kinds = $this->product_kinds;
                
            
                return view("product", compact('pageName', 'results', 
                        'code', 'product_kinds', 'kind', 'shop_type',
                        'showMenu'
                ));
        }

        public function update() {
                $method = $this->request->getMethod();
                if (strtoupper($method) == 'POST') {
                        $id = $this->request->getVar("id");
                        $field = $this->request->getVar("field");
                        $value = $this->request->getVar("value");
                       
                        $data = array(
                                $field => $value
                        );

                        $productModel = new \App\Models\ProductModel();
                        $productModel->updateProduct($id, $data);
                }
        }

        public function create() {
                $method = $this->request->getMethod();
                if (strtoupper($method) == 'POST') {
                        $title = $this->request->getVar("title");
                        $design_for = $this->request->getVar("design_for");
                        $kind = $this->request->getVar("kind");
                        $shop_type = $this->request->getVar("shop_type");

                        $errors = [];
                        if (empty($title)) {
                                
                                $errors[] = 'Please input title!';
                        }

                        if (empty($kind)) {
                                
                                $errors[] = 'Please input kind!';
                        }

                        if (!empty($errors)) {
                                $session = session();
                                $session->setFlashdata('errors', $errors);
                                return redirect()->route('product');
                        }

                        $code = 'M' . date('His') . $this->myFunc->generateRandomString(4, true);
                        $data = array(
                                'code' => $code,
                                'title' => $title,
                                'design_for' => $design_for,
                                'kind' => $kind,
                                'shop_type' => $shop_type
                        );

                        $productModel = new \App\Models\ProductModel();
                        $productModel->insertProduct($data);
                }
                return redirect()->route('product');
        }
}
