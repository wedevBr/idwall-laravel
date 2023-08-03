<?php

use WeDevBr\IdWall\Http\Clients\Report;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

// Test createReport
it('can create a report', function () {
    Http::fake(['*/relatorios' => Http::response(['created' => true], 200)]);
    $client = new Report();
    $response = $client->createReport('someMatrix', ['param1' => 'value1']);
    expect($response)->toBe(['created' => true]);
});

it('throws request exception on failure when creating report', function () {
    Http::fake(['*/relatorios' => Http::response([], 500)]);
    $client = new Report();
    expect(fn() => $client->createReport('someMatrix', ['param1' => 'value1']))->toThrow(RequestException::class);
});

// Test getReportStatus
it('can get report status', function () {
    Http::fake(['*/relatorios/*' => Http::response(['status' => 'OK'], 200)]);
    $client = new Report();
    $response = $client->getReportStatus('reportId123');
    expect($response)->toBe(['status' => 'OK']);
});

it('throws request exception on failure when getting report status', function () {
    Http::fake(['*/relatorios/*' => Http::response([], 500)]);
    $client = new Report();
    expect(fn() => $client->getReportStatus('reportId123'))->toThrow(RequestException::class);
});

// Test getReportValidations
it('can get report validations', function () {
    Http::fake(['*/relatorios/*/validacoes' => Http::response(['validations' => 'data'], 200)]);
    $client = new Report();
    $response = $client->getReportValidations('reportId123');
    expect($response)->toBe(['validations' => 'data']);
});

it('throws request exception on failure when getting report validations', function () {
    Http::fake(['*/relatorios/*/validacoes' => Http::response([], 500)]);
    $client = new Report();
    expect(fn() => $client->getReportValidations('reportId123'))->toThrow(RequestException::class);
});

// Test manualValidation
it('can manually validate a report', function () {
    Http::fake(['*/relatorios/validar/*' => Http::response(['validated' => true], 200)]);
    $client = new Report();
    $response = $client->manualValidation('reportId123', 'Validation message');
    expect($response)->toBe(['validated' => true]);
});

it('throws request exception on failure when manually validating', function () {
    Http::fake(['*/relatorios/validar/*' => Http::response([], 500)]);
    $client = new Report();
    expect(fn() => $client->manualValidation('reportId123', 'Validation message'))->toThrow(RequestException::class);
});

// Test getReportData
it('can get report data', function () {
    Http::fake(['*/relatorios/*/dados' => Http::response(['data' => 'value'], 200)]);
    $client = new Report();
    $response = $client->getReportData('reportId123');
    expect($response)->toBe(['data' => 'value']);
});

it('throws request exception on failure when getting report data', function () {
    Http::fake(['*/relatorios/*/dados' => Http::response([], 500)]);
    $client = new Report();
    expect(fn() => $client->getReportData('reportId123'))->toThrow(RequestException::class);
});

// Test getReportQuery
it('can get report query', function () {
    Http::fake(['*/relatorios/*/consultas' => Http::response(['query' => 'data'], 200)]);
    $client = new Report();
    $response = $client->getReportQuery('reportId123');
    expect($response)->toBe(['query' => 'data']);
});

it('throws request exception on failure when getting report query', function () {
    Http::fake(['*/relatorios/*/consultas' => Http::response([], 500)]);
    $client = new Report();
    expect(fn() => $client->getReportQuery('reportId123'))->toThrow(RequestException::class);
});

// Test getReportParameters
it('can get report parameters', function () {
    Http::fake(['*/relatorios/*/parametros' => Http::response(['parameters' => 'value'], 200)]);
    $client = new Report();
    $response = $client->getReportParameters('reportId123');
    expect($response)->toBe(['parameters' => 'value']);
});

it('throws request exception on failure when getting report parameters', function () {
    Http::fake(['*/relatorios/*/parametros' => Http::response([], 500)]);
    $client = new Report();
    expect(fn() => $client->getReportParameters('reportId123'))->toThrow(RequestException::class);
});

// Test getAllReports
it('can get all reports with pagination and sorting', function () {
    Http::fake(['*/relatorios*' => Http::response(['reports' => 'all'], 200)]);
    $client = new Report();
    $response = $client->getAllReports(1, 25, ['filter' => 'value'], 'orderByField');
    expect($response)->toBe(['reports' => 'all']);
});

it('throws request exception on failure when getting all reports', function () {
    Http::fake(['*/relatorios' => Http::response([], 500)]);
    $client = new Report();
    expect(fn() => $client->getAllReports())->toThrow(RequestException::class);
});

// Test getPendingReports
it('can get pending reports', function () {
    Http::fake(['*/relatorios/pendentes' => Http::response(['pending' => 'data'], 200)]);
    $client = new Report();
    $response = $client->getPendingReports();
    expect($response)->toBe(['pending' => 'data']);
});

it('throws request exception on failure when getting pending reports', function () {
    Http::fake(['*/relatorios/pendentes' => Http::response([], 500)]);
    $client = new Report();
    expect(fn() => $client->getPendingReports())->toThrow(RequestException::class);
});
