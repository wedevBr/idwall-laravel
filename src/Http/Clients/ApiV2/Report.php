<?php

namespace WeDevBr\IdWall\Http\Clients\ApiV2;

use Illuminate\Http\Client\RequestException;
use WeDevBr\IdWall\Http\BaseClient;

class Report extends BaseClient
{
    /**
     * @param string $matrix
     * @param array $dataParameters
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/what-is-a-report
     */
    public function createReport(string $matrix, array $dataParameters): mixed
    {
        $data = [
            'matriz' => $matrix,
            'parametros' => $dataParameters
        ];
        return $this->post('/relatorios', $data);
    }

    /**
     * @param string $reportId
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/get-report
     */
    public function getReportStatus(string $reportId): mixed
    {
        return $this->get("/relatorios/{$reportId}");
    }

    /**
     * @param string $reportId
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/reports-validations
     */
    public function getReportValidations(string $reportId): mixed
    {
        return $this->get("/relatorios/{$reportId}/validacoes");
    }

    /**
     * @param string $reportId
     * @param string $message
     * @return array|mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/manual-validation
     */
    public function manualValidation(string $reportId, string $message): mixed
    {
        $data = [
            'message' => $message,
            'aprovar' => true,
        ];
        return $this->post("/relatorios/validar/{$reportId}", $data);
    }

    /**
     * @param string $reportId
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/reports-data
     */
    public function getReportData(string $reportId): mixed
    {
        return $this->get("/relatorios/{$reportId}/dados");
    }

    /**
     * @param string $reportId
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/reports-queries
     */
    public function getReportQuery(string $reportId): mixed
    {
        return $this->get("/relatorios/{$reportId}/consultas");
    }

    /**
     * @param string $reportId
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/reports-parameters
     */
    public function getReportParameters(string $reportId): mixed
    {
        return $this->get("/relatorios/{$reportId}/parametros");
    }

    /**
     * @param int $page
     * @param int $limit
     * @param array $filters
     * @param string|null $orderBy
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/listing-reports
     */
    public function getAllReports(int $page = 1, int $limit = 25, array $filters = [], string $orderBy = null): mixed
    {
        $pagination = [
            'page' => $page,
            'limit' => $limit
        ];
        $query = array_merge($pagination, $filters);

        if ($orderBy) {
            $query['sort'] = $orderBy;
        }
        return $this->get('/relatorios', $query);
    }

    /**
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/reference/obter-relatorios-nao-concluídos
     */
    public function getPendingReports(): mixed
    {
        return $this->get('/relatorios/pendentes');
    }
}
