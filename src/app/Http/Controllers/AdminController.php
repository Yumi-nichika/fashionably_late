<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    /**
     * 管理画面表示
     */
    public function index()
    {
        $contacts = Contact::with('category')->Paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }

    /**
     * 検索
     */
    public function search(Request $request)
    {
        $target = $request->all();

        $main_query = Contact::with('category');

        // フリーワード（名前・メール）
        if (!empty($target['free'])) {
            $free = $target['free'];

            $main_query->where(function ($query) use ($free) {
                $query->where(DB::raw("CONCAT(last_name, first_name)"), 'LIKE', "%{$free}%")
                    ->orWhere('last_name', 'LIKE', "%{$free}%")
                    ->orWhere('first_name', 'LIKE', "%{$free}%")
                    ->orWhere('email', 'LIKE', "%{$free}%");
            });
        }

        // 性別
        if (!empty($target['gender'])) {
            if ($target['gender'] != 0) {
                $main_query->where('gender', $target['gender']);
            }
        }

        // カテゴリ
        if (!empty($target['category_id'])) {
            $main_query->where('category_id', $target['category_id']);
        }

        // 日付（created_at）
        if (!empty($target['created_at'])) {
            $main_query->whereDate('created_at', $target['created_at']);
        }

        $contacts = $main_query->Paginate(7)->appends($request->query());
        $categories = Category::all();

        return view('admin', compact('contacts', 'categories'));
    }

    /**
     * お問い合わせ削除
     */
    public function remove(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin');
    }

    /**
     * エクスポート
     */
    public function export(Request $request)
    {
        $target = $request->all();

        $main_query = Contact::with('category');

        if (!empty($target)) {
            // フリーワード（名前・メール）
            if (!empty($target['free'])) {
                $free = $target['free'];

                $main_query->where(function ($query) use ($free) {
                    $query->where(DB::raw("CONCAT(last_name, first_name)"), 'LIKE', "%{$free}%")
                        ->orWhere('last_name', 'LIKE', "%{$free}%")
                        ->orWhere('first_name', 'LIKE', "%{$free}%")
                        ->orWhere('email', 'LIKE', "%{$free}%");
                });
            }

            // 性別
            if (!empty($target['gender'])) {
                if ($target['gender'] != 0) {
                    $main_query->where('gender', $target['gender']);
                }
            }

            // カテゴリ
            if (!empty($target['category_id'])) {
                $main_query->where('category_id', $target['category_id']);
            }

            // 日付（created_at）
            if (!empty($target['created_at'])) {
                $main_query->whereDate('created_at', $target['created_at']);
            }
        }

        $contacts = $main_query->get();

        $response = new StreamedResponse(function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");

            // ヘッダー行
            fputcsv($handle, [
                'お名前',
                '性別',
                'メールアドレス',
                'お問い合わせの種類'
            ]);

            // データ行
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->last_name . '　' . $contact->first_name,
                    config('gender')[$contact->gender],
                    $contact->email,
                    $contact->category->content
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set(
            'Content-Disposition',
            'attachment; filename="contacts.csv"'
        );

        return $response;
    }
}
