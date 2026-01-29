<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->get();
        return view('admin.payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $payload = $request->validate([
                'payment_method' => 'required|string|min:3|max:255|unique:payments,payment_method',
            ], [
                'payment_method.required' => 'Metode pembayaran wajib diisi!',
                'payment_method.min' => 'Metode pembayaran minimal 3 karakter!',
                'payment_method.max' => 'Metode pembayaran maksimal 255 karakter!',
                'payment_method.unique' => 'Metode pembayaran sudah digunakan!',
            ]);

            if (!isset($payload['payment_method'])) {
                return redirect()->route('admin.payments.index')->with('error', 'Metode pembayaran wajib diisi.');
            }

            Payment::create([
                'payment_method' => $payload['payment_method'],
            ]);

            return redirect()->route('admin.payments.index')->with('success', 'Payment "' . $payload['payment_method'] . '" berhasil ditambahkan!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
         try {
            $payload = $request->validate([
                'payment_method' => "required|string|min:3|max:255|unique:payments,payment_method,{$payment->id}",
            ], [
                'payment_method.required' => 'Metode pembayaran wajib diisi!',
                'payment_method.min' => 'Metode pembayaran minimal 3 karakter!',
                'payment_method.max' => 'Metode pembayaran maksimal 255 karakter!',
                'payment_method.unique' => 'Metode pembayaran sudah digunakan!',
            ]);

            if (!isset($payload['payment_method'])) {
                return redirect()->route('admin.payments.index')->with('error', 'Metode pembayaran wajib diisi.');
            }

            $payment->update([
                'payment_method' => $payload['payment_method'],
            ]);

            return redirect()->route('admin.payments.index')->with('success', 'Metode pembayaran berhasil diperbarui menjadi "' . $payload['payment_method'] . '"!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        try {
            $payment = Payment::findOrFail($payment->id);

            $payment->delete();

            return redirect()->route('admin.payments.index')->with('success', "Metode pembayaran \"{$payment}\" berhasil dihapus!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
