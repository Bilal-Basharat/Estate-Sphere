import { computed, isRef } from "vue";

export const useMonthlyPayments = (total, profitRate, duration) => {
  
    const monthlyPayment = computed(() => {
  
    const propertyPrice = isRef(total) ? total.value : total;
    const decProfitRate = (isRef(profitRate) ? profitRate.value : profitRate) / 100;
    const numberOfPaymentMonths = (isRef(duration) ? duration.value : duration) * 12;

    const totalCost = propertyPrice * (1 + decProfitRate);

    return totalCost / numberOfPaymentMonths;
})

const totalPaid = computed(() => {
    return (isRef(duration) ? duration.value : duration) * 12 * monthlyPayment.value
})

const totalProfit = computed(() => {
    return totalPaid.value - (isRef(total) ? total.value  : total); 
})

return {monthlyPayment, totalPaid, totalProfit}
}