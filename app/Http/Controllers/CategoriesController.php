<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Category $category, Request $request, Topic $topic)
    {
        // ��ȡ���� ID �����Ļ��⣬����ÿ 20 ����ҳ
        $topics = $topic->withOrder($request->order)
            ->where('category_id', $category->id)
            ->with('user', 'category')   // Ԥ���ط�ֹ N+1 ����
            ->paginate(20);

        // ���α�������ͷ��ൽģ����
        return view('topics.index', compact('topics', 'category'));
    }
}
