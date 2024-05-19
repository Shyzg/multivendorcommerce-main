<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class subscribersExport implements FromCollection, \Maatwebsite\Excel\Concerns\WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Exporting `newsletter_subscribers` database table
        // return \App\Models\NewsletterSubscriber::all(); // Export everything in the database table
        // Exporting some specific database table columns, not all columns

        $subscriberData = \App\Models\NewsletterSubscriber::select('id', 'email', 'created_at')->where('status', 1)->orderBy('id', 'Desc')->get();
        return $subscriberData;
    }

    // Export `newsletter_subscribers` database table as an Excel file WITH THE TABLE HEADINGS    
    public function headings(): array
    {
        // We create/name the table headings of the columns we are exporting/returning from the `newsletter_subscribers` table i.e. `id`, `email` and `created_at` columns

        return ['ID', 'EMAIL', 'SUBSCRIBED ON (date)'];
    }
}
