<?php

namespace InetStudio\ContestsPackage\Contests\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\Uploads\Validation\Rules\CropSize;
use InetStudio\ContestsPackage\Contests\Contracts\Http\Requests\Back\SaveItemRequestContract;

/**
 * Class SaveItemRequest.
 */
class SaveItemRequest extends FormRequest implements SaveItemRequestContract
{
    /**
     * Определить, авторизован ли пользователь для этого запроса.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Сообщения об ошибках.
     *
     * @return array
     */
    public function messages(): array
    {
        $previewCrops = config('contests.images.crops.contest.preview') ?? [];

        $cropMessages = [];

        foreach ($previewCrops as $previewCrop) {
            $cropMessages['preview.crop.'.$previewCrop['name'].'.required'] = 'Необходимо выбрать область отображения '.$previewCrop['ratio'];
            $cropMessages['preview.crop.'.$previewCrop['name'].'.json'] = 'Область отображения '.$previewCrop['ratio'].' должна быть представлена в виде JSON';
        }

        return array_merge([
            'meta.title.max' => 'Поле «Title» не должно превышать 255 символов',
            'meta.description.max' => 'Поле «Description» не должно превышать 255 символов',
            'meta.keywords.max' => 'Поле «Keywords» не должно превышать 255 символов',

            'meta.og:title.max' => 'Поле «og:itle» не должно превышать 255 символов',
            'meta.og:description.max' => 'Поле «og:description» не должно превышать 255 символов',

            'og_image.crop.default.json' => 'Область отображения должна быть представлена в виде JSON',

            'title.required' => 'Поле «Заголовок» обязательно для заполнения',
            'title.max' => 'Поле «Заголовок» не должно превышать 255 символов',

            'slug.required' => 'Поле «URL» обязательно для заполнения',
            'slug.alpha_dash' => 'Поле «URL» может содержать только латинские символы, цифры, дефисы и подчеркивания',
            'slug.max' => 'Поле «URL» не должно превышать 255 символов',
            'slug.unique' => 'Такое значение поля «URL» уже существует',

            'preview.file.required' => 'Поле «Превью» обязательно для заполнения',
            'preview.description.max' => 'Поле «Описание» не должно превышать 255 символов',
            'preview.copyright.max' => 'Поле «Copyright» не должно превышать 255 символов',
            'preview.alt.required' => 'Поле «Alt» обязательно для заполнения',
            'preview.alt.max' => 'Поле «Alt» не должно превышать 255 символов',

            'tags.array' => 'Поле «Теги» должно содержать значение в виде массива',

            'publish_date.date_format' => 'Поле «Время публикации» должно быть в формате дд.мм.гггг чч:мм',
        ], $cropMessages);
    }

    /**
     * Правила проверки запроса.
     *
     * @return array
     */
    public function rules(): array
    {
        $previewCrops = config('contests.images.crops.contest.preview') ?? [];

        $cropRules = [];

        foreach ($previewCrops as $previewCrop) {
            $cropRules['preview.crop.'.$previewCrop['name']] = [
                'nullable',
                'json',
                new CropSize($previewCrop['size']['width'], $previewCrop['size']['height'],
                    $previewCrop['size']['type'], $previewCrop['ratio']),
            ];
        }

        return array_merge([
            'meta.title' => 'max:255',
            'meta.description' => 'max:255',
            'meta.keywords' => 'max:255',
            'meta.og:title' => 'max:255',
            'meta.og:description' => 'max:255',

            'og_image.crop.default' => [
                'nullable',
                'json',
                new CropSize(968, 475, 'min', ''),
            ],

            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|max:255|unique:contests,slug,'.$this->get('contest_id'),

            'preview.description' => 'max:255',
            'preview.copyright' => 'max:255',
            'preview.alt' => 'required|max:255',
            'tags' => 'array',
            'publish_date' => 'nullable|date_format:d.m.Y H:i',
        ], $cropRules);
    }
}
