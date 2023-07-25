<?php namespace App\Controllers;

use App\Models\Data_model;
use CodeIgniter\Controller;

class DataController extends Controller
{
    public function index()
    {
        $model = model('App\Models\Data_model');

        // Get the data from the model
        $data = $model->get_data();

        // Pass the data to the view
        return view('data_view', ['data' => $data]);
}

    public function load_more_data()
    {
        // Get the current page number from the AJAX request
        $page = $this->request->getVar('page');

        // Get the next batch of data using the Data_model
        $data_model = new Data_model();
        $data = $data_model->get_data($page);

        // Return the new data as a JSON response
        return $this->response->setJSON($data);
    }
}
