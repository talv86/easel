<?php

namespace Easel\Http\Jobs;

use Carbon\Carbon;
use Easel\Models\Category;
use Easel\Models\Post;
use Easel\Models\Tag;

class PostFormFields extends Job
{
    /**
     * The id (if any) of the Post row.
     *
     * @var int
     */
    protected $id;
    /**
     * List of fields and default value for each field.
     *
     * @var array
     */
    protected $fieldList = [
        'title'            => '',
        'slug'             => '',
        'subtitle'         => '',
        'page_image'       => '',
        'content'          => '',
        'meta_description' => '',
        'is_draft'         => '0',
        'published_at'     => '',
        'updated_at'       => '',
        'layout'           => '',
        'tags'             => [],
        'category_id'      => '',
        'author_id'        => '',
        'featured_post'    => '0',
    ];

    /**
     * Create a new command instance.
     *
     * @param int $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * Execute the command.
     *
     * @return array of field names => values
     */
    public function handle()
    {
        $fields = $this->fieldList;
        if ($this->id) {
            $fields = $this->fieldsFromModel($this->id, $fields);
        } else {
            $fields['published_at'] = Carbon::now()->addHour()->format('d/m/Y H:i:s');
        }
        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }

        return array_merge(
            $fields,
            [
                'allTags'       => Tag::all()->reduce(function ($tags, $tag) {
                    $tags[]['name'] = $tag->name;

                    return $tags;
                }),
                'allCategories' => Category::pluck('name', 'id')->all(),
            ]
        );
    }

    /**
     * Return the field values from the model.
     *
     * @param int   $id
     * @param array $fields
     *
     * @return array
     */
    protected function fieldsFromModel($id, array $fields)
    {
        $post = Post::findOrFail($id);
        $fieldNames = array_keys(array_except($fields, ['tags']));
        $fields = ['id' => $id];
        foreach ($fieldNames as $field) {
            $fields[$field] = $post->{$field};
        }
        $fields['published_at'] = $post->published_at->format('d/m/Y H:i:s');
        $fields['tags'] = $post->tags->reduce(function ($tags, $tag) {
            $tags[]['name'] = $tag->name;

            return $tags;
        });

        return $fields;
    }
}
