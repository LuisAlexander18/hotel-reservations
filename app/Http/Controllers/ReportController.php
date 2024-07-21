<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Inventory;
use App\Models\Admin;
use App\Models\CardPayment;
use App\Models\InventoryAssignment;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentsExport;
use App\Exports\ReservationsExport;
use App\Exports\CustomersExport;
use App\Exports\RoomsExport;
use App\Exports\InventoriesExport;
use App\Exports\AdminsExport;
use App\Exports\CardPaymentsExport;
use App\Exports\InventoryAssignmentsExport;
use App\Exports\UsersExport;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function generatePaymentsReport(Request $request)
    {
        $query = Payment::with(['room', 'customer', 'user', 'reservation']);

        if ($request->filled('room')) {
            $query->whereHas('room', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->room . '%');
            });
        }

        if ($request->filled('customer')) {
            $query->whereHas('customer', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer . '%');
            });
        }

        if ($request->filled('user')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%');
            });
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('payment_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('payment_date', '<=', $request->to_date);
        }

        // Si el formato es Excel o PDF, obtenemos todos los datos sin paginación
        if ($request->get('format') == 'excel') {
            $payments = $query->get();
            return Excel::download(new PaymentsExport($payments), 'payments.xlsx');
        } elseif ($request->get('format') == 'pdf') {
            $payments = $query->get();
            $pdf = PDF::loadView('admin.reports.payments_pdf', compact('payments'))->setPaper('a4', 'landscape');
            return $pdf->download('payments.pdf');
        }

        // Para la vista HTML, usamos paginación
        $payments = $query->paginate(10);
        return view('admin.reports.payments', compact('payments'));
    }


    public function generateReservationsReport(Request $request)
    {
        $query = Reservation::with(['user', 'room', 'customer']);

        // Aplicar filtros (si existen)
        if ($request->filled('user')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%');
            });
        }

        if ($request->filled('room')) {
            $query->whereHas('room', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->room . '%');
            });
        }

        if ($request->filled('customer')) {
            $query->whereHas('customer', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('check_in_date')) {
            $query->whereDate('check_in_date', '>=', $request->check_in_date);
        }

        if ($request->filled('check_out_date')) {
            $query->whereDate('check_out_date', '<=', $request->check_out_date);
        }

        // Ordenar para que las reservaciones con cliente asignado aparezcan primero
        $query->orderByRaw("customer_id IS NULL, customer_id");

        if ($request->get('format') == 'excel') {
            $reservations = $query->get();
            return Excel::download(new ReservationsExport($reservations), 'reservations.xlsx');
        } elseif ($request->get('format') == 'pdf') {
            $reservations = $query->get();
            $pdf = PDF::loadView('admin.reports.reservations_pdf', compact('reservations'))->setPaper('a4', 'landscape');
            return $pdf->download('reservations.pdf');
        }

        $reservations = $query->paginate(10);
        return view('admin.reports.reservations', compact('reservations'));
    }




    public function generateCustomersReport(Request $request)
    {
        $query = Customer::query();

        // Aplicar filtros (si existen)
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('identification')) {
            $query->where('identification', 'like', '%' . $request->identification . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        // Si el formato es Excel o PDF, obtenemos todos los datos sin paginación
        if ($request->get('format') == 'excel') {
            $customers = $query->get();
            return Excel::download(new CustomersExport($customers), 'customers.xlsx');
        } elseif ($request->get('format') == 'pdf') {
            $customers = $query->get();
            $pdf = PDF::loadView('admin.reports.customers_pdf', compact('customers'))->setPaper('a4', 'landscape');
            return $pdf->download('customers.pdf');
        }

        // Para la vista HTML, usamos paginación
        $customers = $query->paginate(10);
        return view('admin.reports.customers', compact('customers'));
    }


    public function generateRoomsReport(Request $request)
    {
        $query = Room::query();

        // Aplicar filtros (si existen)
        if ($request->filled('room_number')) {
            $query->where('room_number', 'like', '%' . $request->room_number . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', 'like', '%' . $request->type . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Si el formato es Excel o PDF, obtenemos todos los datos sin paginación
        if ($request->get('format') == 'excel') {
            $rooms = $query->get();
            return Excel::download(new RoomsExport($rooms), 'rooms.xlsx');
        } elseif ($request->get('format') == 'pdf') {
            $rooms = $query->get();
            $pdf = PDF::loadView('admin.reports.rooms_pdf', compact('rooms'))->setPaper('a4', 'landscape');
            return $pdf->download('rooms.pdf');
        }

        // Para la vista HTML, usamos paginación
        $rooms = $query->paginate(10);
        return view('admin.reports.rooms', compact('rooms'));
    }


    public function generateInventoriesReport(Request $request)
    {
        $query = Inventory::query();

        // Aplicar filtros (si existen)
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        if ($request->filled('quantity_from')) {
            $query->where('quantity', '>=', $request->quantity_from);
        }

        if ($request->filled('quantity_to')) {
            $query->where('quantity', '<=', $request->quantity_to);
        }

        // Si el formato es Excel o PDF, obtenemos todos los datos sin paginación
        if ($request->get('format') == 'excel') {
            $inventories = $query->get();
            return Excel::download(new InventoriesExport($inventories), 'inventories.xlsx');
        } elseif ($request->get('format') == 'pdf') {
            $inventories = $query->get();
            $pdf = PDF::loadView('admin.reports.inventories_pdf', compact('inventories'))->setPaper('a4', 'landscape');
            return $pdf->download('inventories.pdf');
        }

        // Para la vista HTML, usamos paginación
        $inventories = $query->paginate(10);
        return view('admin.reports.inventories', compact('inventories'));
    }


    public function generateAdminsReport(Request $request)
    {
        $query = Admin::query();

        // Aplicar filtros (si existen)
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('identification')) {
            $query->where('identification', 'like', '%' . $request->identification . '%');
        }

        // Si el formato es Excel o PDF, obtenemos todos los datos sin paginación
        if ($request->get('format') == 'excel') {
            $admins = $query->get();
            return Excel::download(new AdminsExport($admins), 'admins.xlsx');
        } elseif ($request->get('format') == 'pdf') {
            $admins = $query->get();
            $pdf = PDF::loadView('admin.reports.admins_pdf', compact('admins'))->setPaper('a4', 'landscape');
            return $pdf->download('admins.pdf');
        }

        // Para la vista HTML, usamos paginación
        $admins = $query->paginate(10);
        return view('admin.reports.admins', compact('admins'));
    }


    public function generateCardPaymentsReport(Request $request)
    {
        $query = CardPayment::with(['customer', 'room', 'user', 'reservation', 'admin']);

        // Aplicar filtros (si existen)
        if ($request->filled('customer')) {
            $query->whereHas('customer', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->customer . '%');
            });
        }

        if ($request->filled('room')) {
            $query->whereHas('room', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->room . '%');
            });
        }

        if ($request->filled('user')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user . '%');
            });
        }

        if ($request->filled('admin')) {
            $query->whereHas('admin', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->admin . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // Si el formato es Excel o PDF, obtenemos todos los datos sin paginación
        if ($request->get('format') == 'excel') {
            $cardPayments = $query->get();
            return Excel::download(new CardPaymentsExport($cardPayments), 'card_payments.xlsx');
        } elseif ($request->get('format') == 'pdf') {
            $cardPayments = $query->get();
            $pdf = PDF::loadView('admin.reports.card_payments_pdf', compact('cardPayments'))->setPaper('a4', 'landscape');
            return $pdf->download('card_payments.pdf');
        }

        // Para la vista HTML, usamos paginación
        $cardPayments = $query->paginate(7);
        return view('admin.reports.card_payments', compact('cardPayments'));
    }



    public function generateInventoryAssignmentsReport(Request $request)
    {
        $query = InventoryAssignment::with(['inventory']);

        // Aplicar filtros (si existen)
        if ($request->filled('inventory')) {
            $query->whereHas('inventory', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->inventory . '%');
            });
        }

        if ($request->filled('assignable_type')) {
            $query->where('assignable_type', 'like', '%' . $request->assignable_type . '%');
        }

        if ($request->filled('assignable_id')) {
            $query->where('assignable_id', 'like', '%' . $request->assignable_id . '%');
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        // Si el formato es Excel o PDF, obtenemos todos los datos sin paginación
        if ($request->get('format') == 'excel') {
            $inventoryAssignments = $query->get();
            return Excel::download(new InventoryAssignmentsExport($inventoryAssignments), 'inventory_assignments.xlsx');
        } elseif ($request->get('format') == 'pdf') {
            $inventoryAssignments = $query->get();
            $pdf = PDF::loadView('admin.reports.inventory_assignments_pdf', compact('inventoryAssignments'))->setPaper('a4', 'landscape');
            return $pdf->download('inventory_assignments.pdf');
        }

        // Para la vista HTML, usamos paginación
        $inventoryAssignments = $query->paginate(10);
        return view('admin.reports.inventory_assignments', compact('inventoryAssignments'));
    }


    public function generateUsersReport(Request $request)
{
    $query = User::query();

    // Aplicar filtros (si existen)
    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    if ($request->filled('role')) {
        $query->where('role', $request->role);
    }

    if ($request->filled('created_at')) {
        $query->whereDate('created_at', $request->created_at);
    }

    // Si el formato es Excel o PDF, obtenemos todos los datos sin paginación
    if ($request->get('format') == 'excel') {
        $users = $query->get();
        return Excel::download(new UsersExport($users), 'users.xlsx');
    } elseif ($request->get('format') == 'pdf') {
        $users = $query->get();
        $pdf = PDF::loadView('admin.reports.users_pdf', compact('users'))->setPaper('a4', 'landscape');
        return $pdf->download('users.pdf');
    }

    // Para la vista HTML, usamos paginación
    $users = $query->paginate(10);
    return view('admin.reports.users', compact('users'));
}

}
