<table class="table table-hover">
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td class="col-1">{{ $item->work_content }}</td>
                <td class="col-1">{{ $item->date_book }}</td>
                <td class="col-1">{{ $item->warranty_period }}</td>
                <td class="col-1">{{ $item->name_cus }}</td>
                <td class="col-1">{{ $item->add_cus }}</td>
                <td class="col-1">{{ $item->des_cus }}</td>
                <td class="col-1">{{ $item->phone_cus }}</td>
                <td class="col-1">{{ $item->note_cus }}</td>
                <td class="col-1">{{ $item->worker_name }}</td>
                <td class="col-1">{{ $item->spending_total }}</td>
                <td class="col-1">{{ $item->income_total }}</td>
                <td class="col-1">{{ $item->seri_number }}</td>
            </tr>
        @endforeach
        @foreach ($search as $item)
            <tr>
                <td class="col-1">{{ $item->work_content }}</td>
                <td class="col-1">@if ( $item->date_book ==  $item->warranty_time)
                    {{ $item->date_book }}
                @else
                {{ $item->date_book }} Tới {{ $item->warranty_time }}
                @endif</td>
                <td class="col-1">{{ $item->warranty_info }}</td>
                <td class="col-1">{{ $item->name_cus }}</td>
                <td class="col-1">{{ $item->street }}</td>
                <td class="col-1">{{ $item->district }}</td>
                <td class="col-1">{{ $item->phone_number }}</td>
                <td class="col-1">{{ $item->real_note }}</td>
                <td class="col-1">{{ $item->worker_name }}</td>
                <td class="col-1">{{ $item->spending_total }}</td>
                <td class="col-1">{{ $item->income_total }}</td>
                <td class="col-1">{{ $item->seri_number }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
