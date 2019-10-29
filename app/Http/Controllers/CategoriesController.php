<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        // ��ȡ���� ID �����Ļ��⣬����ÿ 20 ����ҳ
        $topics = Topic::where('category_id', $category->id)->paginate(20);
        // ���α�������ͷ��ൽģ����
        return view('topics.index', compact('topics', 'category'));
    }
}
