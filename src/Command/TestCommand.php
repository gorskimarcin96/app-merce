<?php

namespace App\Command;

use App\HTTP\Auth\BasicAllegro;
use App\HTTP\Auth\JWTAllegro;
use App\HTTP\HTTP;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

#[AsCommand(name: 'app:test-http', description: 'Command for test my HTTP module.',)]
class TestCommand extends Command
{
    public function __construct(private HTTP $http, private ParameterBagInterface $parameterBag)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->http->setAuth(
            new BasicAllegro($this->parameterBag->get('allegro.id'),
                $this->parameterBag->get('allegro.secret'))
        );
        $response = $this->http->post(
            'https://allegro.pl/auth/oauth/token?grant_type=client_credentials&scope=allegro:api:sale:settings:write%20allegro:api:sale:settings:read'
        );
        $token = json_decode($response->getBody()->getContents())->access_token;
        $io->title('First response with auth: ');
        $io->info($response->getBody());


        $this->http->setAuth(new JWTAllegro($token));
        $response = $this->http->post(
            'https://api.allegro.pl/sale/offer-contacts',
            json_encode([
                'name' => 'test',
                'emails' => [['address' => 'test@test.pl']],
                'phones' => [['number' => '123456789']]
            ]),
            ['Content-Type' => 'application/vnd.allegro.public.v1+json']
        );
        $io->title('Add sale offer contacts: ');
        $io->info($response->getBody());


        $response = $this->http->get('https://api.allegro.pl/sale/offer-contacts');
        $io->title('Sale offer contacts: ');
        $io->info($response->getBody());


        return Command::SUCCESS;
    }
}
