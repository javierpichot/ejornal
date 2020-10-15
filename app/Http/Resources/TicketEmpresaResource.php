<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketEmpresaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'user' => new UserTicketResource($this->whenLoaded('user')),
            'empresa' => new EmpresaResource($this->whenLoaded('empresa')),
            'motivo' => $this->motivo,
            'comentario' => $this->comentario,
            'observacion' => $this->observacion,
            'accion_user' => new ActionUserTicketResource($this->whenLoaded('accion_user')),
            'roles' => RolesTicketResource::collection($this->whenLoaded('roles')),
        ];
    }
}
