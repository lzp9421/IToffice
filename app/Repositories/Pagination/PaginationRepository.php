<?php
/**
 * Created by PhpStorm.
 * User: MyStudio
 * Date: 2016/12/13
 * Time: 19:07
 */
namespace App\Repositories\Pagination;
use Illuminate\Pagination\BootstrapThreePresenter;

/**
 * 自定义分页
 */

class PaginationRepository extends BootstrapThreePresenter
{
    public function render()
    {
        if ($this->hasPages())
        {
            return sprintf(
                '<ul class="am-pagination am-pagination-centered">%s %s %s</ul>',
                $this->getPreviousButton(),
                $this->getLinks(),
                $this->getNextButton()
            );
        }

        return '';
    }

    /**
     * Get HTML wrapper for disabled text.
     * 自定义上一页和下一页按钮禁用样式
     *
     * @param  string  $text
     * @return string
     */
    protected function getDisabledTextWrapper($text)
    {
        return '<li class="am-disabled"><span>'.$text.'</span></li>';
    }

    /**
     * Get HTML wrapper for active text.
     * 自定义当前页按钮样式
     * @param  string  $text
     * @return string
     */
    protected function getActivePageWrapper($text)
    {
        return '<li class="am-active"><span>'.$text.'</span></li>';
    }


    /**
     * Get HTML wrapper for an available page link.
     * 自定义上一页和下一页按钮样式
     *
     * @param  string  $url
     * @param  int  $page
     * @param  string|null  $rel
     * @return string
     */
    protected function getAvailablePageWrapper($url, $page, $rel = null)
    {
        $rel = is_null($rel) ? '' : ' rel="'.$rel.'"';

        return '<li><a href="'.htmlentities($url).'"'.$rel.'>'.$page.'</a></li>';
    }


    /**
     * Get the previous page pagination element.
     * 重写 BootstrapThreeNextPreviousButtonRendererTrait 上一页按钮
     *
     * @param  string  $text
     * @return string
     */
    public function getPreviousButton($text = '&laquo;')
    {
        // If the current page is less than or equal to one, it means we can't go any
        // further back in the pages, so we will render a disabled previous button
        // when that is the case. Otherwise, we will give it an active "status".
        if ($this->paginator->currentPage() <= 1) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->paginator->url(
            $this->paginator->currentPage() - 1
        );

        return $this->getPageLinkWrapper($url, $text, 'prev');
    }

    /**
     * Get the next page pagination element.
     *
     * @param  string  $text
     * @return string
     */
    public function getNextButton($text = '&raquo;')
    {
        // If the current page is greater than or equal to the last page, it means we
        // can't go any further into the pages, as we're already on this last page
        // that is available, so we will make it the "next" link style disabled.
        if (! $this->paginator->hasMorePages()) {
            return $this->getDisabledTextWrapper($text);
        }

        $url = $this->paginator->url($this->paginator->currentPage() + 1);

        return $this->getPageLinkWrapper($url, $text, 'next');
    }

    /**
     * Get HTML wrapper for a page link.
     * 重写 UrlWindowPresenterTrait 中 getPageLinkWrapper 方法,让上一页下一页样式不一样
     *
     * @param  string  $url
     * @param  int  $page
     * @param  string|null  $rel
     * @return string
     */
    protected function getPageLinkWrapper($url, $page, $rel = null)
    {
        if ($page == $this->paginator->currentPage()) {
            return $this->getActivePageWrapper($page);
        }

        return $this->getAvailablePageWrapper($url, $page, $rel);
    }
}