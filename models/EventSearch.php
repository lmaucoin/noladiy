<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Event;

/**
 * EventsSearch represents the model behind the search form of `app\models\Events`.
 */
class EventSearch extends Event
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'venue_id'], 'integer'],
            [['venue_other', 'title', 'description', 'price', 'date', 'start_time', 'min_age', 'booking_name', 'booking_email', 'external_link'], 'safe'],
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
        $query = Event::find();

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
            'id' => $this->id,
            'venue_id' => $this->venue_id,
            'date' => $this->date,
            'start_time' => $this->start_time,
        ]);

        $query->andFilterWhere(['like', 'venue_other', $this->venue_other])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'min_age', $this->min_age])
            ->andFilterWhere(['like', 'booking_name', $this->booking_name])
            ->andFilterWhere(['like', 'booking_email', $this->booking_email])
            ->andFilterWhere(['like', 'external_link', $this->external_link]);

        return $dataProvider;
    }
}
