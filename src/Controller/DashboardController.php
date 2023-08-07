<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Symfony\UX\Chartjs\Builder\ChartBuilder;
use Symfony\UX\Chartjs\Model\Chart;
use Psr\Container\ContainerInterface;

class DashboardController extends Controller
{
    private $chartBuilder;

    public function __construct(ContainerInterface $ci, ChartBuilder $chartBuilder)
    {
        parent::__construct($ci);
        $this->chartBuilder = $chartBuilder;
    }

    public function default(Request $request, Response $response)
    {
        $user_data = json_decode(file_get_contents(__DIR__ . '/../../data/user_data.json'), true);
        $fatture_emesse = json_decode(file_get_contents(__DIR__ . '/../../data/fatture_emesse.json'), true);
        $fatture_ricevute = json_decode(file_get_contents(__DIR__ . '/../../data/fatture_ricevute.json'), true);
        $clienti = json_decode(file_get_contents(__DIR__ . '/../../data/clienti.json'), true);
        $fornitori = json_decode(file_get_contents(__DIR__ . '/../../data/fornitori.json'), true);
        $prodotti = json_decode(file_get_contents(__DIR__ . '/../../data/prodotti.json'), true);
        $news = json_decode(file_get_contents(__DIR__ . '/../../data/news.json'), true);

        require_once __DIR__ . '/../../helpers/functions.php';

        $twig = $this->ci->get('templating');

        $twig->addFunction(new \Twig\TwigFunction('filter_by_status', 'filter_by_status'));
        $twig->addFunction(new \Twig\TwigFunction('calculate_total_price', 'calculate_total_price'));
        $twig->addFunction(new \Twig\TwigFunction('filtered_data', 'filtered_data'));

        $chartData = $this->getChartData();

        return $this->render($response, 'dashboard/dashboard.twig', [
            'user_data' => $user_data,
            'fatture_emesse' => $fatture_emesse,
            'fatture_ricevute' => $fatture_ricevute,
            'summary_data' => filtered_data($fatture_emesse, $fatture_ricevute),
            'clienti' => count($clienti),
            'fornitori' => count($fornitori),
            'prodotti' => count($prodotti),
            'news' => $news,
            'chartData' => $chartData,
        ]);
    }

    public function getChartData()
    {
        $chartBuilder = $this->chartBuilder;

        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => [
                'gennaio',
                'febbraio',
                'marzo',
                'aprile',
                'maggio',
                'giugno',
                'luglio',
                'agosto',
                'settembre',
                'ottobre',
                'novembre',
                'dicembre'
              ],
            'datasets' => [
                [
                    'backgroundColor' => 'rgb(255, 255, 255)',
                    'borderColor' => 'rgb(228, 229, 231',
                    'data' => [0, 2000, 4000, 6000, 8000, 10000, 12000, 14000],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        return $chart;
    }
}
