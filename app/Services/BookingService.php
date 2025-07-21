<?php

namespace App\Services;

use App\Http\Resources\BookingCollection;
use App\Repositories\BookingRepository;
use Illuminate\Support\Facades\Auth;

class BookingService extends BaseService
{
    protected $repository;

    public function __construct(BookingRepository $bookingRepo)
    {
        $this->repository = $bookingRepo;
    }

    /**
     * Get all bookings for authenticated user.
     *
     * @return BookingCollection
     */
    public function getAllForAuthUser()
    {
        $userId = Auth::id();

        return new BookingCollection($this->bookingRepo->getByUserIdWithRelations($userId));
    }
}
