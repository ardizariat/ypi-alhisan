<x-admin-app-layout title="{{ $data['title'] }}">
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $data['title'] }}</h3>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="shadow card">
                        <div class="card-content">
                            <div class="card-body">
                                <div style="width:100%; height:700px;" id="tree" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <x-slot name="js">
        <script src="{{ asset('assets/vendors/orgCharts/orgchart.js') }}"></script>
        <script>
            var chart = new OrgChart(document.getElementById("tree"), {
                enableSearch: false,
                enableDragDrop: true,
                template: "polina",
                enableSearch: false,
                mouseScrool: OrgChart.action.none,
                nodeBinding: {
                    field_0: "name",
                    field_1: "title",
                    img_0: "img"
                },
                nodes: [{
                        id: 1,
                        name: "DEWAN PEMBINA",
                    },
                    {
                        id: 2,
                        pid: 0,
                        name: "DEWAN PENGAWAS",
                    },
                    {
                        id: 3,
                        pid: 1,
                        name: "KETUA DEWAN PENGURUS",
                    },
                    {
                        id: 4,
                        pid: 3,
                        name: "SEKRETARIS",
                    },
                    {
                        id: 5,
                        pid: 3,
                        name: "BENDAHARA",
                    }

                ]
            });
        </script>
    </x-slot>
</x-admin-app-layout>
