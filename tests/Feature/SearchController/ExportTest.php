<?php

namespace Tests\Feature\SearchController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function returns_a_downloadable_file()
    {
        factory(Book::class, 10)->create();

        $response = $this->call('GET', 'repository/export', $this->ExportSearchRequest())
            ->assertOk();

        $this->assertEquals( get_class($response->baseResponse), BinaryFileResponse::class);

        //$file = $response->getFile();
        //dd( file_get_contents($file));
    }

    /** @test */
    public function requires_one_field_to_export()
    {
        $response = $this->call('GET', 'repository/export', array_merge($this->ExportSearchRequest(), ['fieldsToExport' => []]))
        ->assertSessionHasErrors('fieldsToExport');
    }
    
    /**@test */
    public function requires_export_format(){
        $response = $this->call('GET', 'repository/export', array_merge($this->ExportSearchRequest(), ['exportFormat' => null]))
        ->assertSessionHasErrors('exportFormat');
    }

    /** @test */
    public function requires_one_search_by_field()
    {
        $response = $this->call('GET', 'repository/export', array_merge($this->ExportSearchRequest(), ['searchBy' => []]))
        ->assertSessionHasErrors('searchBy');
    }
    

    /** @test */
    public function validates_test_cases()
    {
        ExportTestCases::MockBookRepository();

        foreach(ExportTestCases::GetTestCases() as $testCase){
            $response = $this->call('GET', 'repository/export', array_merge($this->SearchRequest(), $testCase['ExportRequest']));

            //Line breaks are all evaluated as \n to avoid test cases from different OS's from failing
            $fileContent = $this->MakeLineBreaksUniform(file_get_contents($response->getFile()));
            $expectedFileContent = $this->MakeLineBreaksUniform(file_get_contents($testCase['ExpectedFile']));

            $this->assertEquals($expectedFileContent, $fileContent);
        }
    }
    
    private function MakeLineBreaksUniform($text){
        $text = str_replace("\r\n", "\n", $text);
        return str_replace("\r", "\n", $text);
    }

    private function ExportSearchRequest(){
        return array_merge($this->SearchRequest(), $this->ExportRequest());
    }

    private function SearchRequest(){
        return [
            'searchTerm' => null, 
            'searchBy' => ['title' => 'title'],
            'orderBy' => 'title',
            'order' => 'asc'
        ];
    }

    private function ExportRequest(){
        return [
            'fieldsToExport' => ['Title' => 'Title', 'Author' => 'Author'],
            'exportFormat' => 'XML'
        ];
    }
}
