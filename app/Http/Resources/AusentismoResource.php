<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AusentismoResource extends JsonResource
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
            'fecha_ausente' => $this->fecha_ausente,
            'empresa_id' => encrypt($this->empresa_id),
            'tipo' => new  AusentismoTipoResource($this->whenLoaded('ausentismo_tipo')),
            'motivo' => $this->motivo,
            'fecha_alta' => $this->fecha_alta,
            'numero_comunicacion' => $this->comunicacion_count,
            'numero_documentacion' => $this->documentacion_count,
            'numero_consulta' => $this->consulta_count,
            'dias_ausente' => $this->dias_ausente,
            'user' => new UserTicketResource($this->whenLoaded('user')),
            'trabajador' => new TrabajadorAusentismoResource($this->whenLoaded('trabajador'))
        ];
    }
}
