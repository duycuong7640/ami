<?php

namespace App\Providers;

use App\Repository\Admins\Account\AccountRepository;
use App\Repository\Admins\Account\AccountRepositoryInterface;
use App\Repository\Admins\Advertisement\AdvertisementRepository;
use App\Repository\Admins\Advertisement\AdvertisementRepositoryInterface;
use App\Repository\Admins\Comment\CommentRepository;
use App\Repository\Admins\Comment\CommentRepositoryInterface;
use App\Repository\Admins\Mailtemplate\MailtemplateRepository;
use App\Repository\Admins\Mailtemplate\MailtemplateRepositoryInterface;
use App\Repository\Admins\Cart\CartRepository;
use App\Repository\Admins\Cart\CartRepositoryInterface;
use App\Repository\Admins\Category\CategoryRepository;
use App\Repository\Admins\Category\CategoryRepositoryInterface;
use App\Repository\Admins\CrawlerCategory\CrawlerCategoryRepository;
use App\Repository\Admins\CrawlerCategory\CrawlerCategoryRepositoryInterface;
use App\Repository\Admins\CrawlerWebsite\CrawlerWebsiteRepository;
use App\Repository\Admins\CrawlerWebsite\CrawlerWebsiteRepositoryInterface;
use App\Repository\Admins\Product\ProductRepository;
use App\Repository\Admins\Product\ProductRepositoryInterface;
use App\Repository\Admins\RedirectUrl\RedirectUrlRepository;
use App\Repository\Admins\RedirectUrl\RedirectUrlRepositoryInterface;
use App\Repository\Clients\Cart\ClientCartRepository;
use App\Repository\Clients\Cart\ClientCartRepositoryInterface;
use App\Repository\Clients\Contact\ClientContactRepository;
use App\Repository\Clients\Contact\ClientContactRepositoryInterface;
use App\Repository\Clients\Category\ClientCategoryRepository;
use App\Repository\Clients\Category\ClientCategoryRepositoryInterface;
use App\Repository\Clients\Post\ClientPostRepository;
use App\Repository\Clients\Post\ClientPostRepositoryInterface;
use App\Repository\Clients\Product\ClientProductRepository;
use App\Repository\Clients\Product\ClientProductRepositoryInterface;
use App\Repository\Clients\User\ClientUserRepository;
use App\Repository\Clients\User\ClientUserRepositoryInterface;
use App\Repository\IA\IA\IARepository;
use App\Repository\IA\IA\IARepositoryInterface;
use App\Repository\Admins\Post\PostRepository;
use App\Repository\Admins\Post\PostRepositoryInterface;
use App\Repository\Admins\Setting\SettingRepository;
use App\Repository\Admins\Setting\SettingRepositoryInterface;
use App\Repository\Clients\Setting\SettingRepository as SettingRepositoryClient;
use App\Repository\Clients\Setting\SettingRepositoryInterface as SettingRepositoryInterfaceClient;
use App\Repository\Clients\Advertisement\AdvertisementRepository as AdvertisementRepositoryClient;
use App\Repository\Clients\Advertisement\AdvertisementRepositoryInterface as AdvertisementRepositoryInterfaceClient;
use App\Repository\Clients\Mailtemplate\MailtemplateRepository as MailtemplateRepositoryClient;
use App\Repository\Clients\Mailtemplate\MailtemplateRepositoryInterface as MailtemplateRepositoryInterfaceClient;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->bind(AdvertisementRepositoryInterface::class, AdvertisementRepository::class);
        
        $this->app->bind(MailtemplateRepositoryInterface::class, MailtemplateRepository::class);
        
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(CrawlerWebsiteRepositoryInterface::class, CrawlerWebsiteRepository::class);
        $this->app->bind(CrawlerCategoryRepositoryInterface::class, CrawlerCategoryRepository::class);

        $this->app->bind(RedirectUrlRepositoryInterface::class, RedirectUrlRepository::class);

        //Client
        $this->app->bind(SettingRepositoryInterfaceClient::class, SettingRepositoryClient::class);
        $this->app->bind(AdvertisementRepositoryInterfaceClient::class, AdvertisementRepositoryClient::class);
        $this->app->bind(ClientCategoryRepositoryInterface::class, ClientCategoryRepository::class);
        $this->app->bind(ClientProductRepositoryInterface::class, ClientProductRepository::class);
        $this->app->bind(ClientPostRepositoryInterface::class, ClientPostRepository::class);
        $this->app->bind(ClientUserRepositoryInterface::class, ClientUserRepository::class);
        $this->app->bind(ClientCartRepositoryInterface::class, ClientCartRepository::class);
        $this->app->bind(ClientContactRepositoryInterface::class, ClientContactRepository::class);

        //IA
        $this->app->bind(IARepositoryInterface::class, IARepository::class);
    }
}