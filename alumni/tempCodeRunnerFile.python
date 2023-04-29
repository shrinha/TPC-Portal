!pip install pymoo
import numpy as np
from pymoo.core.problem import ElementwiseProblem
from pymoo.algorithms.moo.nsga2 import NSGA2
from pymoo.operators.crossover.sbx import SBX
from pymoo.operators.mutation.pm import PM
from pymoo.operators.sampling.rnd import FloatRandomSampling
from pymoo.termination import get_termination
from pymoo.optimize import minimize
import matplotlib.pyplot as plt

class Prob1(ElementwiseProblem):

    def _init_(self):
        super()._init_(n_var=2,
                         n_obj=2,
                         n_ieq_constr=0,
                         xl=np.array([-5,-5]),
                         xu=np.array([5,5]))

    def _evaluate(self, x, out, *args, **kwargs):
        f1 = x[0]**2 + x[1]**2
        f2 = (x[0]-1)**2 +(x[1]-1)**2

        out["F"] = [f1, f2]


problem = Prob1()
termination = get_termination("n_gen", 200)
algorithm = NSGA2(
    pop_size=100,
    n_offsprings=10,
    sampling=FloatRandomSampling(),
    crossover=SBX(prob=0.9, eta=15),
    mutation=PM(eta=20),
    eliminate_duplicates=True
)
res = minimize(problem,
               algorithm,
               termination,
               seed=42,
               save_history=True)

X = res.X
F = res.F

plt.figure(figsize=(7, 5))
plt.scatter(F[:, 0], F[:, 1], s=30, facecolors='blue', edgecolors='none')
plt.title("Pareto Optimal Front")
plt.show()