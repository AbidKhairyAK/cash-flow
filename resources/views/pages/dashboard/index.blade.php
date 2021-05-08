<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="grid gap-6">
		<div class="grid lg:grid-cols-4 gap-6">
			<a href="{{ route('incomes.create') }}" class="lg:h-full h-24 flex items-center justify-center text-center bg-primary hover:bg-quaternary text-white font-bold text-2xl rounded shadow">
				<span>+ Catat Pemasukan</span>
			</a>
			<x-card class="border-l-4 border-primary">
				<h2 class="font-bold text-xl">Pemasukan Bulan Ini</h2>
				<p>Rp {{ number_format($currentMonthIncome, 0, '', '.') }}</p>
			</x-card>
			<x-card class="border-l-4 border-secondary">
				<h2 class="font-bold text-xl">Pemasukan Bulan Lalu</h2>
				<p>Rp {{ number_format($prevMonthIncome, 0, '', '.') }}</p>
			</x-card>
			<x-card class="border-l-4 border-tertiary">
				<h2 class="font-bold text-xl">Pemasukan Kemarin</h2>
				<p>Rp {{ number_format($yesterdayIncome, 0, '', '.') }}</p>
			</x-card>
		</div>
		<div class="grid lg:grid-cols-3 gap-6">
			<x-card>
				<div id="daily-incomes" style="height: 325px;"></div>
			</x-card>
			<x-card>
				<div id="monthly-incomes" style="height: 325px;"></div>
			</x-card>
			<x-card>
				<div id="monthly-stores-incomes" style="height: 325px;"></div>
			</x-card>
		</div>
	</div>

	<x-slot name="endscript">
		<script src="https://unpkg.com/chart.js@2.9.3/dist/Chart.min.js"></script>
		<script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
		<script type="text/javascript">
			function generateBarOptions (data) {
				const min = Number(Math.min(...data.datasets[0].values))
				const max = Number(Math.max(...data.datasets[0].values))
				const additionalHeight = min / 6
				return { options: { 
					scales: { 
						xAxes: [{ gridLines: {
							// display: false
						}}],
						yAxes: [{ ticks: {
							min: min - additionalHeight,
							max: max + additionalHeight,
							display: false,
						}}]
					},
					plugins: { labels: {
						render: ({ value }) => window._formatNumber(value)
					}}
				}}
			}

			const doughnutOptions = { options: { plugins: { labels: {
				render: ({value, label}) => label + ': \n' + window._formatNumber(value),
				fontColor: '#FFF',
				// position: 'border'
			}}}}

			window.onload = function () {

				const dailyIncomeData = {
					chart: { labels: [
						@foreach($dailyIncome as $income) 
							_formatDate('{{ $income->date->format("Y-m-d") }}', 'date monthName'), 
						@endforeach
					]},
					datasets: [ { name: 'Pemasukan (Rp)', values: [
						@foreach($dailyIncome as $income)
							{{ $income->total }}, 
						@endforeach  		
				  	]}]
				}

				const dailyIncomeChart = new Chartisan({
					el: '#daily-incomes',
					data: dailyIncomeData,
					hooks: new ChartisanHooks()
						.title('Pemasukan per-hari')
						.colors(['#299691'])
						.responsive()
						.legend(false)
						.options(generateBarOptions(dailyIncomeData))
				})

				const monthlyIncomeData = {
					chart: { labels: [
						@foreach($monthlyIncome as $income) 
							'{{ $income->month }}', 
						@endforeach
					]},
					datasets: [ { name: 'Pemasukan (Rp)', values: [
						@foreach($monthlyIncome as $income)
							{{ $income->total }}, 
						@endforeach
				  	]}]
				}

				const monthlyIncomeChart = new Chartisan({
					el: '#monthly-incomes',
					data: monthlyIncomeData,
					hooks: new ChartisanHooks()
						.title('Pemasukan per-bulan')
						.colors(['#FCB46A'])
						.responsive()
						.legend(false)
						.options(generateBarOptions(monthlyIncomeData))
				})

				const storesIncomesData = {
					chart: { labels: ['CPI', 'Toko Lantai 2', 'Penjualan Online', 'Event Hijab Expo'] },
					datasets: [
					  { name: 'Pemasukan', values: [7000000, 3000000, 10000000, 2000000] },
					],

					chart: { labels: [
						@foreach($prevMonthStoreIncome as $income) 
							'{{ $income->store->name }}', 
						@endforeach
					]},
					datasets: [ { name: 'Pemasukan (Rp)', values: [
						@foreach($prevMonthStoreIncome as $income)
							{{ $income->total }},
						@endforeach
				  	]}]
				}

				const storesIncomesChart = new Chartisan({
					el: '#monthly-stores-incomes',
					data: storesIncomesData,
					hooks: new ChartisanHooks()
						.title('Pemasukan per-toko/event bulan lalu')
						.datasets('pie')
						.pieColors()
						.responsive()
						.legend(false)
						.options(doughnutOptions)
				})
			}
		</script>
	</x-slot>
</x-app-layout>
