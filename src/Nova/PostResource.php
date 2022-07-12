<?php

namespace MennoTempelaar\NovaNewsTool\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Panel;
use Marshmallow\CharcountedFields\TextCounted;
use MennoTempelaar\NovaNewsTool\Models\PostModel;
use MennoTempelaar\NovaNewsTool\Utils\Prefix;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;


class PostResource extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = PostModel::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'contents',
    ];

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     *
     * @inheritdoc
     */
    public static function label (): string
    {

        return Prefix::translate( 'resource.label' );

    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     *
     * @inheritdoc
     */
    public static function singularLabel (): string
    {

        return Prefix::translate( 'resource.singularLabel' );

    }

    /**
     * Get the fields displayed by the resource.
     *
     * @returns array<int, Field|Panel>
     *
     * @inheritdoc
     */
    public function fields ( NovaRequest $request ): array
    {

        return [

            Panel::make( Prefix::translate( 'resource.fields.general-panel' ), [
                TextCounted::make(
                    Prefix::translate( 'resource.fields.title' ),
                    'title'
                )
                    ->rules( 'required' )
                    ->minChars( 10 )
                    ->maxChars( 120 )
                    ->warningAt( 70 )
                    ->help( Prefix::translate( 'resource.fields.title-help' ) ),

                Slug::make(
                    Prefix::translate( 'resource.fields.slug' ),
                    'slug',
                )
                    ->help( Prefix::translate( 'resource.fields.slug-help' ) )
                    ->showOnUpdating()
                    ->hideWhenCreating()
                    ->hideFromIndex(),

                Image::make(
                    Prefix::translate( 'resource.fields.poster' ),
                    'image',
                )->help( Prefix::translate( 'resource.fields.poster-help' ) ),

                Trix::make(
                    Prefix::translate( 'resource.fields.contents' ),
                    'contents',
                )->stacked(),

            ] )->withToolbar(),

            Panel::make( Prefix::translate( 'resource.fields.visibility-panel' ), [
                Boolean::make(
                    Prefix::translate( 'resource.fields.hidden' ),
                    'hidden',
                )->help( Prefix::translate( 'resource.fields.hidden-help' ) ),

                DateTime::make(
                    Prefix::translate( 'resource.fields.published-at' ),
                    'published_at',
                )
                    ->nullable()
                    ->help( Prefix::translate( 'resource.fields.published-at-help' ) ),

                DateTime::make(
                    Prefix::translate( 'resource.fields.published-till' ),
                    'published_till',
                )
                    ->nullable()
                    ->help( Prefix::translate( 'resource.fields.published-till-help' ) ),

            ] )->help( Prefix::translate( 'resource.fields.visibility-panel-help' ) ),

            Panel::make( Prefix::translate( 'resource.fields.technical-panel' ), [
                ID::make()->onlyOnDetail(),

                DateTime::make(
                    Prefix::translate( 'resource.fields.updated' ),
                    'updated_at',
                )
                    ->readonly()
                    ->onlyOnDetail(),

                Stack::make( Prefix::translate( 'resource.fields.created-by' ), [

                    BelongsTo::make(
                        Prefix::translate( 'resource.fields.created-by' ),
                        'createdBy',
                        self::class,
                    )
                        ->readonly()
                        ->onlyOnDetail()
                        ->displayUsing( function ( $value ) {

                            return $value->name;
                        } ),

                    DateTime::make(
                        Prefix::translate( 'resource.fields.created' ),
                        'created_at',
                    )
                        ->readonly()
                        ->onlyOnDetail(),

                ] )->onlyOnDetail()->readonly(),


                DateTime::make(
                    Prefix::translate( 'resource.fields.deleted' ),
                    'deleted_at',
                )
                    ->readonly()
                    ->onlyOnDetail(),
            ] ),

        ];

    }

    /**
     * Get the fields displayed by the resource within the index.
     *
     * @returns array<int, Field|Panel>
     */
    public function fieldsForIndex (): array
    {

        return [

            Image::make(
                Prefix::translate( 'resource.fields.poster' ),
                'image',
            ),

            Stack::make( Prefix::translate( 'resource.fields.index-stack' ), [
                Line::make( 'title' )
                    ->extraClasses( 'inline-block' )
                    ->asHeading(),

                Line::make( 'contents' )
                    ->resolveUsing( fn () => strip_tags( optional( $this->resource )->contents ) )
                    ->extraClasses( 'inline-block truncate max-w-sm' )
                    ->asSmall(),
            ] ),

            Stack::make( Prefix::translate( 'resource.fields.created-by' ), [

                BelongsTo::make(
                    Prefix::translate( 'resource.fields.created-by' ),
                    'createdBy',
                    self::class,
                )
                    ->displayUsing( function ( $value ) {

                        return $value->name;

                    } ),

                DateTime::make(
                    Prefix::translate( 'resource.fields.created' ),
                    'created_at',
                ),

            ] ),

        ];

    }

    /**
     * Get the cards available for the request.
     *
     * @param  NovaRequest  $request
     *
     * @return array
     */
    public function cards ( NovaRequest $request ): array
    {

        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  NovaRequest  $request
     *
     * @return array
     */
    public function filters ( NovaRequest $request ): array
    {

        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  NovaRequest  $request
     *
     * @return array
     */
    public function lenses ( NovaRequest $request ): array
    {

        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  NovaRequest  $request
     *
     * @return array
     */
    public function actions ( NovaRequest $request ): array
    {

        return [];
    }

}
