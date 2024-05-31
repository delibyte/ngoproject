<x-layout>
    <x-setting :heading="'Edit Indigent Application'" class="w-10/12 mx-auto">
        <form id="indigentForm" method="POST" action="{{ route('indigent.application.update', $indigent->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <x-form.input name="name" :value="$indigent->user->name" disabled />

            <x-form.field>
                <x-form.label name="Region" />
                <select name="region_id" required class="p-2 rounded-md">
                    @foreach (\App\Models\Area::all() as $area)
                        <option
                            value="{{ $area->id }}"
                            {{ old('region_id') == $area->id ? 'selected' : '' }}
                        >{{ ucwords($area->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="type_id"/>
            </x-form.field>

            <x-form.input name="income" type="number" :value="old('income', $indigent->income)" required />
            <x-form.input name="expenditure" type="number" :value="old('expenditure', $indigent->expenditure)" required />

            <x-form.field>
                <x-form.label name="Aid Type" />
                <select name="aid_type" required class="p-2 rounded-md">
                    @foreach (\App\Models\DonationType::all() as $type)
                        <option
                            value="{{ $type->id }}"
                            {{ $indigent->aidType->id == $type->id ? 'selected' : '' }}
                        >{{ ucwords($type->name) }}</option>
                    @endforeach
                </select>
                <x-form.error name="aid_type"/>
            </x-form.field>

            <x-form.field>
                <x-form.label name="Family Members" />
                <div class="p-2 w-7/12 rounded-md border mb-4">
                    <table class="table-auto w-full" id="family_members_table" name="family_members_table">
                        <thead>
                            <tr>
                                <th class="text-sm"> Underage? </th>
                                <th class="text-sm"> Educational Status </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($indigent->family as $member)
                            <tr class="border-t border-gray-200">
                                <th class="p-2 font-normal text-sm">{{ $member->is_child ? "Yes" : "No" }}</th>
                                <th class="font-normal text-sm">{{ ( $member->educational_status == "primary" ||
                                                                    $member->education_status == "seconday" ) ?
                                                                    ucfirst($member->educational_status) . " School" :
                                                                    ucfirst($member->educational_status) }}</th>
                                <th><button type="button" class="removeRow bg-red-300 rounded-md px-2"> ⊖ </button></th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-row items-start">
                    <div>
                        <x-form.label name="Underage?" />
                        <select id="underage" name="underage" class="p-2 rounded-md">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                        </select>
                    </div>

                    <div class="ml-2">
                        <x-form.label name="Educational Status" />
                        <select id="educational_status" name="educational_status" class="p-2 rounded-md">
                                <option value="illiterate">Illiterate</option>
                                <option value="literate">Literate</option>
                                <option value="primary">Primary School</option>
                                <option value="secondary">Secondary School</option>
                                <option value="highschool">Highschool</option>
                                <option value="university">University</option>
                                <option value="postgraduate">Postgraduate</option>
                                <option value="doctorate">Doctorate</option>
                        </select>
                    </div>

                    <button id="addRow" type="button" class="ml-4 rounded-md border border-gray-200 p-2 mt-6 bg-blue-400 font-bold text-white"> Add </button>
                </div>

                <x-form.error name="family_members"/>
            </x-form.field>

            <x-button id="updateButton" class="mt-6">Update</x-button>
        </form>

        <script>
        $(document).ready(function(){
            $("#addRow").click(function(event)
            {
                var underage = $("#underage").find("option:selected").text();
                var educational_status = $("#educational_status").find("option:selected").text();

                let newRow = ' <tr class="border-t border-gray-200"> \
                               <th class="p-2 font-normal text-sm">' + underage + '</th> \
                               <th class="font-normal text-sm">' + educational_status + '</th> \
                              <th><button type="button" class="removeRow bg-red-300 rounded-md px-2"> ⊖ </button></th></tr>';
                $("#family_members_table tbody").append(newRow);

            });

            $(document).on('click', '.removeRow', function() {
                $(this).closest('tr').remove();
            });

            $("#indigentForm").submit( function( event ) {
                var formData = new FormData($("#indigentForm")[0]);
                var tableData = [];

                $("#family_members_table tbody tr").each( function(row,tr) {
                    tableData[row] = {
                        "underage" : $(tr).find('th:eq(0)').text(),
                        "educational_status": $(tr).find('th:eq(1)').text().toLowerCase(),
                    }
                });

                var serializedData = JSON.stringify(tableData);

                $('<input>').attr({
                    type: 'hidden',
                    name: 'familyMembers',
                    value: serializedData
                }).appendTo('#indigentForm');

                return true;
            });
        });
        </script>
    </x-setting>
</x-layout>
