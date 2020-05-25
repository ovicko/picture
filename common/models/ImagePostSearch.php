<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ImagePost;

/**
 * ImagePostSearch represents the model behind the search form of `common\models\ImagePost`.
 */
class ImagePostSearch extends ImagePost
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'category_id', 'user_id', 'region_id', 'state_id', 'views_count', 'status'], 'integer'],
            [['unique_id', 'main_image_url', 'resolution', 'camera', 'device_name', 'date_taken', 'date_added', 'tags', 'thumbnail_url'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ImagePost::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'post_id' => $this->post_id,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
            'region_id' => $this->region_id,
            'state_id' => $this->state_id,
            'views_count' => $this->views_count,
            'date_taken' => $this->date_taken,
            'date_added' => $this->date_added,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'unique_id', $this->unique_id])
            ->andFilterWhere(['like', 'main_image_url', $this->main_image_url])
            ->andFilterWhere(['like', 'resolution', $this->resolution])
            ->andFilterWhere(['like', 'camera', $this->camera])
            ->andFilterWhere(['like', 'device_name', $this->device_name])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'thumbnail_url', $this->thumbnail_url]);

        return $dataProvider;
    }
}
