<?php

namespace App\BlogApi;

use App\Models\Post;
use App\Models\BlogFeed;
use App\Models\Category;
use App\BlogApi\Data\Responses\Article;
use App\BlogApi\Adapters\BlogApiAdapter;
use App\BlogApi\Data\Responses\BlogResponse;
use App\BlogApi\Contracts\BlogApiServiceContract;
use Illuminate\Support\Facades\DB;

class BlogApiService extends BlogResponse implements BlogApiServiceContract
{


    public function __construct(
        protected BlogApiAdapter $adapter
    ) {
    }

    private function setProperty(array $propertyList)
    {
        foreach ($propertyList as $key => $value) {

            $this->$key = $value;
        }
    }

    public function import(): BlogFeed
    {
        $response = $this->adapter->getPosts();

        $blogFeed = BlogFeed::create([
            'response' => json_encode($response)
        ]);

        return $blogFeed;
    }


    public function process(): int
    /** Called By ProcessFeed Job */
    {

        $blogFeed = BlogFeed::isUnprocessed()->get();

        $category =  Category::firstOrCreate(['name' => 'Uncategorized']);

        $postCount = 0;

        foreach ($blogFeed as $response) {


            $this->setProperty(json_decode($response->response, true));

            DB::beginTransaction();

            $response->processing();

            foreach ($this->articles as $article) {

                $article['created_at'] = $article['publishedAt'];

                $postData = Article::fromArray($article);

                if (!Post::where('title', $postData->title)->exists()) {
                    $post = Post::create($postData->toArray());
                    $category->posts()->attach($post);
                    $postCount++;
                }
            }

            $response->processed();

            DB::commit();
        }



        return $postCount;
    }
}
