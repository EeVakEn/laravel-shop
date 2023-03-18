<?php

namespace Webkul\Shop\Http\Controllers;

use Webkul\Category\Models\Category;
use Webkul\Category\Repositories\CategoryRepository;
use Webkul\Shop\Http\Controllers\Controller;
use Webkul\Core\Repositories\SliderRepository;
use Webkul\Product\Repositories\SearchRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param SliderRepository $sliderRepository
     * @param SearchRepository $searchRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        protected SliderRepository   $sliderRepository,
        protected SearchRepository   $searchRepository,
        protected CategoryRepository $categoryRepository,
    )
    {
        parent::__construct();
    }

    /**
     * Loads the home page for the storefront.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $sliderData = $this->sliderRepository->getActiveSliders();
        return view($this->_config['view'], compact('sliderData'));
    }

    /**
     * Loads the home page for the storefront if something wrong.
     *
     * @return \Exception
     */
    public function notFound()
    {
        abort(404);
    }

    /**
     * Upload image for product search with machine learning.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
        return $this->searchRepository->uploadSearchImage(request()->all());
    }
}
