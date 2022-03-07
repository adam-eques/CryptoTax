<?php

namespace App\Http\Livewire\Customer\Dashboard;

use Livewire\Component;

class News extends Component
{
    
    public function render()
    {
        $news = [
            [ 
                'img' => '', 
                'title' => 'Cryptocurrency exchanges start blocking accounts', 
                'content' => 'Data is a real-time snapshot *Data is delayed at least 15 minutes. Global Business and Financial News, Stock Quotes, and Market Data and' 
            ],
            [
                'img' => '', 
                'title' => 'Cryptocurrency exchanges start blocking accounts', 
                'content' => 'Data is a real-time snapshot *Data is delayed at least 15 minutes. Global Business and Financial News, Stock Quotes, and Market Data and' 
            ],
            [
                'img' => '', 
                'title' => 'Cryptocurrency exchanges start blocking accounts', 
                'content' => 'Data is a real-time snapshot *Data is delayed at least 15 minutes. Global Business and Financial News, Stock Quotes, and Market Data and' 
            ]
    
        ]; 

        return view('livewire.customer.dashboard.news', [
            'news' => $news
        ]);
    }
}
